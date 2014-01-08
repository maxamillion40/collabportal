<?php
	class collab	{
		var $id;
		var $name;
		var $starttime;
		var $members;
		var $status;
		var $owner;
		var $desc;
		var $logo;
		var $settings;
		public function __construct($id)	{
			// Load all collab data from DB
			global $_MYSQL;
			$data = $_MYSQL -> get("SELECT * FROM collabs WHERE id=?",array($id));
			$this->id = $data[0]["id"];
			$this->name = $data[0]["name"];
			$this->starttime = $data[0]["start"];
			$this->members = unserialize($data[0]["mitglieder"]);
			$this->status = $data[0]["status"];
			$this->owner = new user($this->members["founder"]);
			$this->desc = $data[0]["desc"];
			$this->logo = $data[0]["logo"];
			$this->settings = unserialize($data[0]["settings"]);
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
		public function close()	{
			// MySQL query for closing
		}
		public function member_rank($name)	{
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
		public function __construct($name)	{
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
		public function send_pm($msg)	{
			global $_MYSQL;
			if(is_object($msg))	{
				$msg -> date = time();
				$msg -> to = $this -> name;
				if($msg -> can_send())	{
					$_MYSQL -> set("INSERT INTO `messages`(`regard`,`date`,`sender`,`to`,`msg`) VALUES(?,?,?,?,?)", array(
						$msg -> regard,
						$msg -> date,
						$msg -> sender -> name,
						$msg -> to,
						$msg -> msg
					));
				}
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
				$data = $_MYSQL -> get("SELECT * FROM messages WHERE `id`='$id'");
				$this -> id = $data[0]["id"];
				$this -> sender = new user($data[0]["sender"]);
				$this -> to = new user($data[0]["to"]);
				$this -> date = $data[0]["date"];
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
	}
?>