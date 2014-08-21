<?php
	/**
		* Use this class when dealing with a collab
		* @package core
		* @since 2014-08-20
	*/
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
		/**
			* Constructor.
			@param int $id Collab ID as known in the database
			@return void
		*/
		public function __construct($id)	{
			// Load all collab data from DB
			global $_MYSQL;
			$data = $_MYSQL -> get("SELECT * FROM collabs WHERE id=?",array($id));
			$this -> id 			= (int) $data[0]["id"];
			$this -> name 			= (string) $data[0]["name"];
			$this -> starttime 		= (object) new time((int) $data[0]["start"]);
			$this -> members 		= (array) unserialize((string) $data[0]["mitglieder"]);
			$this -> status			= (string) $data[0]["status"];
			$this -> owner 			= (object) new user((string) $this->members["founder"]);
			$this -> desc 			= (string) $data[0]["desc"];
			$this -> logo 			= (string) $data[0]["logo"];
			$this -> announcement	= (string) $data[0]["announcement"];
			$this -> pid 			= (int) $data[0]["pid"];
			$this -> lastInternalID = (int) $data[0]["lastInternalID"];
			$this -> settings 		= array(
				"members_max" => $data[0]["setting_members-max"],
				"confirm_join" => $data[0]["setting_confirm-join"],
				"new_members" => $data[0]["setting_new-members"],
				"language" => $data[0]["setting_language"]
			);
			// Create user objects for members
			$max = count($this -> members["people"]);
			for($i=0; $i < $max; $i++)	{
				//Create a new user object by the user's name and insert it as $this -> members["people"][USERNAME]
				$this -> members["people"][$this -> members["people"][$i]] = new user($this -> members["people"][$i]);
				unset($this -> members["people"][$i]);
			}
			// Create user objects for candidates
			$max = count($this -> members["candidates"]);
			for($i=0; $i < $max; $i++)	{
				//Create a new user object by the candidate's name and insert it as $this -> members["candidates"][USERNAME]
				$this -> members["candidates"][$this -> members["candidates"][$i]] = new user($this -> members["candidates"][$i]);
				unset($this->members["candidates"][$i]);
			}
		}
		/**
			* Get the rank of a user in the collab.
			@param string $name Username
			@return string
		*/
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
		/**
			* Add a user to the collab.
			@param string $name Username
			@param string $rank "member" or "candidate", defines to which list the user gets added
			@return void
		*/
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
		/**
			* Remove a user from the collab.
			@param string $name Username
			@param string $rank "member" or "candidate", defines from which list the user is removed
			@return void
		*/
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
		/**
			* Close the collab.
			@return void
		*/
		public function close()	{
			global $_MYSQL;
			$_MYSQL -> set("UPDATE `collabs` SET `status`='closed' WHERE `id`=?", array(
				$this -> id
			));
		}
	}
?>