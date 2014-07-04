<?php 
	class time	{
		var $stamp;
		public function __construct($int = null)	{
			if(!isset($int))	{
				$int = time();
			}
			$this -> stamp = $int;
		}
		public function format($pattern)	{
			if(is_string($pattern))	{
				return date($pattern, $this -> stamp);
			}
			else	{
				trigger_error("Bad argument #1 to time::format(), string expected, got " . gettype($pattern), E_USER_ERROR);
			}
		}
		public function printas($pattern)	{
			if(is_string($pattern))	{
				echo date($pattern, $this -> stamp);
			}
			else	{
				trigger_error("Bad argument #1 to time::format(), string expected, got " . gettype($pattern), E_USER_ERROR);
			}
		}
	}
	class collab	{
		var $id;
		var $lastInternalID;
		var $name;
		var $starttime;
		var $members;
		var $status;
		var $owner;
		var $desc;
		var $logo;
		var $settings;
		var $announcement;
		var $pid;
		public function __construct($id)	{
			// Load all collab data from DB
			global $_MYSQL;
			$data = $_MYSQL -> get("SELECT * FROM collabs WHERE id=?",array($id));
			$this->id = $data[0]["id"];
			$this->name = $data[0]["name"];
			$this->starttime = new time($data[0]["start"]);
			$this->members = unserialize($data[0]["mitglieder"]);
			$this->status = $data[0]["status"];
			$this->owner = new user($this->members["founder"]);
			$this->desc = $data[0]["desc"];
			$this->logo = $data[0]["logo"];
			$this->settings = array(
				"members_max" => $data[0]["setting_members-max"],
				"confirm_join" => $data[0]["setting_confirm-join"],
				"new_members" => $data[0]["setting_new-members"],
				"language" => $data[0]["setting_language"]
			);
			$this->announcement = $data[0]["announcement"];
			$this->pid = $data[0]["pid"];
			$this->lastInternalID = $data[0]["lastInternalID"];
			// Create user objects for members
			$max = count($this->members["people"]);
			for($i=0; $i < $max; $i++)	{
				$this->members["people"][$this->members["people"][$i]] = new user($this->members["people"][$i]);
				unset($this->members["people"][$i]);
			}
			// Create user objects for candidates
			$max = count($this->members["candidates"]);
			for($i=0; $i < $max; $i++)	{
				$this->members["candidates"][$this -> members["candidates"][$i]] = new user($this->members["candidates"][$i]);
				unset($this->members["candidates"][$i]);
			}
		}
		public function member_rank($name)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to collab::member_rank(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			// Return the rank of a user in this collab
			$name = new user($name);
			if(array_key_exists($name -> name, $this -> members["people"]))	{
				return "member";
			}
			elseif(array_key_exists($name -> name, $this -> members["candidates"]))	{
				return "candidate";
			}
			elseif($this -> owner -> name == $name -> name)	{
				return "founder";
			}
			else	{
				return "guest";
			}
		}
		public function add_member($name, $rank)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to collab::add_member(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			if(!is_string($name))	{
				trigger_error("Bad argument #2 to collab::member_rank(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			global $_MYSQL;
			$name = new user($name);
			if($rank == "member")	{
				$this -> members["people"][] = $name;
				if(isset($this -> members["candidates"][$name]))	{
					unset($this -> members["candidates"][$name]);
				}

				$arr = array(
					"founder" => $this -> members["founder"],
					"people" => array(),
					"candidates" => array(),
				);
				
				foreach($this -> members["people"] as $member)	{
					$arr["people"][] = $member -> name;
				}
				foreach($this -> members["candidates"] as $member)	{
					$arr["candidates"][] = $member -> name;
				}

				$_MYSQL -> set("UPDATE collabs SET mitglieder=? WHERE id=?", array(
					serialize($arr),
					$this -> id
				));
			}
			
			if($rank == "candidate")	{
				$this -> members["candidates"][] = $name;

				$arr = array(
					"founder" => $this -> members["founder"],
					"people" => array(),
					"candidates" => array(),
				);
				
				foreach($this -> members["people"] as $member)	{
					$arr["people"][] = $member -> name;
				}
				foreach($this -> members["candidates"] as $member)	{
					$arr["candidates"][] = $member -> name;
				}

				$_MYSQL -> set("UPDATE collabs SET mitglieder=? WHERE id=?", array(
					serialize($arr),
					$this -> id
				));
			}
		}
		public function remove_member($name, $rank)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to collab::remove_member(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			if(!is_string($candidate))	{
				trigger_error("Bad argument #2 to collab::remove_member(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			global $_MYSQL;
			if($rank == "member")	{
				unset($this -> members["people"][$name]);
			}
			if($rank == "candidate")	{
				unset($this -> members["candidates"][$name]);
			}
			
			$arr = array(
				"founder" => $this -> members["founder"],
				"people" => array(),
				"candidates" => array(),
			);
			
			foreach($this -> members["people"] as $member)	{
				$arr["people"][] = $member -> name;
			}
			foreach($this -> members["candidates"] as $member)	{
				$arr["candidates"][] = $member -> name;
			}

			$_MYSQL -> set("UPDATE collabs SET mitglieder=? WHERE id=?", array(
				serialize($arr),
				$this -> id
			));
		}
		public function close()	{
			global $_MYSQL;
			$_MYSQL -> set("UPDATE `collabs` SET `status`='closed' WHERE `id`=?", array(
				$this -> id
			));
		}
	}
	class user	{
		var $id;
		var $name;
		var $pass;
		var $mail;
		var $scratch;
		var $class;
		var $last_login;
		var $last_ip;
		var $online;
		var $language;
		var $signupDate;
		var $lastCollab;
		public function __construct($name)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to user::__construct(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			global $_MYSQL;
			if($name != "Systemnachricht")	{
				$data = $_MYSQL -> get("SELECT * FROM users WHERE name=?",array($name));
				if(count($data) == 1)	{
					$this->id = $data[0]["id"];
					$this->name = $data[0]["name"];
					$this->pass = $data[0]["pass"];
					$this->mail = $data[0]["mail"];
					$this->scratch = $data[0]["scratch"];
					$this->class = $data[0]["class"];
					$this->last_login = $data[0]["last_login"];
					$this->last_ip = $data[0]["last_ip"];
					$this->online = true;
					$this->language = $data[0]["language"];
					$this->signupDate = new time($data[0]["signup"]);
					$this->lastCollab = new time($data[0]["lastcollab"]);
				}
				else	{
					$this->online = false;
				}
			}
			else	{
				$this->id = 0;
				$this->name = "Systemnachricht";
				$this->pass = "X";
				$this->mail = "X";
				$this->scratch = "X";
				$this->class = "user";
				$this->last_login = 0;
				$this->last_ip = "127.0.0.1";
				$this->online = true;
			}
		}
		public function is_online()	{
			if($this->online == true)	{
				return true;
			}
			else	{
				return false;
			}
		}
	}
	class message	{
		var $id;
		var $sender;
		var $to;
		var $date;
		var $regard;
		var $msg;
		var $read;
		public function __construct($id = null)	{
			if(isset($id))	{
				global $_MYSQL;
				$data = $_MYSQL -> get("SELECT * FROM messages WHERE `id`=?", array($id));
				$this -> id = $data[0]["id"];
				$this -> sender = new user($data[0]["sender"]);
				$this -> to = new user($data[0]["to"]);
				$this -> date = new time($data[0]["date"]);
				$this -> regard = $data[0]["regard"];
				$this -> msg = $data[0]["msg"];
				if($data[0]["read"] == 1)	{
					$this -> read = true;
				}
				else	{
					$this -> read = false;
				}
			}
		}
		public function can_send()	{
			if(isset($this -> sender) && isset($this -> to) && isset($this -> regard) && isset($this -> msg))	{
				return true;
			}
			else	{
				return false;
			}
		}
		public function send()	{
			global $_MYSQL;
			if($this -> id == null)	{
				echo $this -> to -> name;
				$_MYSQL -> set("INSERT INTO messages(`date`,`regard`,`sender`,`to`,`msg`) VALUES(?,?,?,?,?)", array(
					$this -> date -> stamp,
					$this -> regard,
					$this -> sender -> name,
					$this -> to -> name,
					$this -> msg
				));
			}
		}
	}
	class collabmessage	{
		var $id;
		var $time;
		var $sender;
		var $collab;
		var $msg;
		var $censored;
		var $internalID;
		function __construct($id = null)	{
			if(isset($id))	{
				global $_MYSQL;
				$data = $_MYSQL -> get("SELECT * FROM collabmessages WHERE `id`=?", array($id));
				$this -> id = $data[0]["id"];
				$this -> time = new time($data[0]["timestamp"]);
				$this -> sender = new user($data[0]["absender"]);
				$this -> collab = new collab($data[0]["collab"]);
				$this -> msg = $data[0]["message"];
				$this -> internalID = $data[0]["internalID"];
				if($data[0]["censored"] == 1)	{
					$this -> censored = true;
				}
				else	{
					$this -> censored = false;
				}
			}
		}
	}
	class page	{
		var $title;
		var $description;
		var $keywords;
		var $robots;
		var $scripts;
		var $styles;
		
		public function __construct()	{
			$this -> scripts = array();
			$this -> styles = array();
			
			foreach(explode(", ", CP_KEYWORDS) as $k)	{
				$this -> keywords[] = $k;
			}
			
			$this -> description = CP_DESCRIPTION;
		}
		
		public function requires_rank($which, $redirectOnInsufficient)	{
			if(!is_int($which))	{
				trigger_error("Bad argument #1 to page::requires_rank(), integer expected, got " . gettype($name), E_USER_ERROR);
			}
			if(!is_string($redirectOnInsufficient))	{
				trigger_error("Bad argument #2 to page::requires_rank(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			global $_USER;
			if($_USER -> class < $which)	{
				header("Location: $redirectOnInsufficient?error=insufficientrank");
			}
		}
		public function setTitle($prefix, $split = NULL)	{
			if(!is_string($prefix))	{
				trigger_error("Bad argument #1 to page::setTitle(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			if($split == NULL)	{
				$split = CP_TITLE_SPLITTER;
			}
			$this -> title = $prefix . " " . $split . " " . CP_NAME;
		}
		public function setDescription($desc)	{
		if(!is_string($desc))	{
				trigger_error("Bad argument #1 to page::setDescription(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			$this -> description = $desc;
		}
		public function addKeywords($keys)	{
			if(!is_array($prefix))	{
				trigger_error("Bad argument #1 to page::add_Keywords(), array expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			foreach($keys as $key)	{
				$this -> keywords[] = $key;
			}
		}
		public function setRobots($commands)	{
			if(!is_array($commands))	{
				trigger_error("Bad argument #1 to page::setRobots(), array expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			$this -> robots = $commands;
		}
		public function useScript($name)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to page::useScript(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			$this -> scripts[] = $name;
		}
		public function useStyle($name)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to page::useStyle(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			$this -> styles[] = $name;
		}
		
		private function tag($tag)	{
			if(!is_string($tag))	{
				trigger_error("Bad argument #1 to page::tag(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			return $tag . BR;
		}
		public function putHeader()	{
			global $_HOME;
			global $_SCRIPTS;
			try	{
				echo $this -> tag("<title>" . $this -> title . "</title>");
				echo $this -> tag("<!-- Meta -->");
				echo $this -> tag("<meta charset=\"UTF-8\" />");
				echo $this -> tag("<meta name=\"description\" content=\"" . $this -> description . "\" />");
				echo $this -> tag("<meta name=\"keywords\" content=\"" . implode(", ", $this -> keywords) . "\" />");
				echo $this -> tag("<meta name=\"robots\" content=\"" . implode(", ", $this -> robots) . "\" />");
				echo $this -> tag("<meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\" />");
				echo $this -> tag("<!-- Styles -->");
				echo $this -> tag("<link rel=\"stylesheet\" href=\"styles/main.css\" />");
				echo $this -> tag("<link rel=\"stylesheet\" href=\"styles/cp.css\" />");
				if(file_exists($_HOME . "/styles/" . basename($_SERVER["PHP_SELF"], ".php") . ".css"))	{
					echo $this -> tag("<link rel=\"stylesheet\" href=\"styles/" . basename($_SERVER["PHP_SELF"], ".php") . ".css\" />");
				}
				foreach($this -> styles as $style)	{
					echo $this -> tag("<link rel=\"stylesheet\" href=\"" . $style . "\" />");
				}
				echo $this -> tag("<!-- Favicon -->");
				echo $this -> tag("<link rel=\"shortcut icon\" href=\"favicon.ico\" />");
				echo $this -> tag("<!-- Scripts -->");
				foreach($this -> scripts as $script)	{
					if(isset($_SCRIPTS[$script]))	{
						foreach($_SCRIPTS[$script]["css"] as $stylesheet)	{
							echo $this -> tag("<link rel=\"stylesheet\" href=\"" . $stylesheet . "\" />");
						}
						foreach($_SCRIPTS[$script]["js"] as $javascript)	{
							echo $this -> tag("<script src=\"" . $javascript . "\"></script>");
						}
					}
					else	{
							echo $this -> tag("<script src=\"" . $script . "\"></script>");
					}
				}
				if(file_exists($_HOME . "/scripts/" . basename($_SERVER["PHP_SELF"], ".php") . ".js"))	{
					echo $this -> tag("<script src=\"scripts/" . basename($_SERVER["PHP_SELF"], ".php") . ".js\"></script>");
				}
				echo $this -> tag("<script src=\"scripts/init.js\"></script>");
			}
			catch(Exception $e)	{
			
			}
		}
	}
?>