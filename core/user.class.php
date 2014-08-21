<?php
	/**
		* Represents a single user.
	*/
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
		/**
			* Constructor.
			@param string $name Username
			@return void
		*/
		public function __construct($name)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to user::__construct(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			global $_MYSQL;
			if($name != "Systemnachricht")	{
				$data = $_MYSQL -> get("SELECT * FROM users WHERE name=?",array($name));
				if(count($data) == 1)	{
					$this -> id 		= (int) $data[0]["id"];
					$this -> name 		= (string) $data[0]["name"];
					$this -> pass 		= (string) $data[0]["pass"];
					$this -> mail 		= (string) $data[0]["mail"];
					$this -> scratch 	= (string) $data[0]["scratch"];
					$this -> class 		= (int) $data[0]["class"];
					$this -> last_login	= (int) $data[0]["last_login"];
					$this -> last_ip 	= (string) $data[0]["last_ip"];
					$this -> online 	= (boolean) true;
					$this -> language 	= (string) $data[0]["language"];
					$this -> signupDate	= (object) new time((int) $data[0]["signup"]);
					$this -> lastCollab	= (object) new time((int) $data[0]["lastcollab"]);
				}
				else	{
					$this -> online = false;
				}
			}
			else	{
				$this -> id = 0;
				$this -> name = "Systemnachricht";
				$this -> pass = "X";
				$this -> mail = "X";
				$this -> scratch = "X";
				$this -> class = "user";
				$this -> last_login = 0;
				$this -> last_ip = "127.0.0.1";
				$this -> online = true;
			}
		}
		/**
			* Check if the user is online (*deprecated*).
			@return boolean
		*/
		public function is_online()	{
			if($this -> online == true)	{
				return true;
			}
			else	{
				return false;
			}
		}
	}
?>