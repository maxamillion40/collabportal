<?php
	/**
		* This class should be used whenever a script wants to interact with a user
		* @package core
		* @since 2014-08-20
	*/
	class user	{
		/**
			* User ID as known in the database
			* @var int
		*/
		public $id;
		
		/**
			* Username
			* @var string
		*/
		public $name;
		
		/**
			* Password, hashed by md5
			* @var string
		*/
		public $pass;
		
		/**
			* E-mail-address
			* @var string
		*/
		public $mail;
		
		/**
			* Scratch username
			* @var string
		*/
		public $scratch;
		
		/**
			* User rank
			* @var string
			* @see CP::USER_GUEST CP::USER_*
		*/
		public $class;
		
		/**
			* Time of last login
			* @var time
		*/
		public $last_login;
		
		/**
			* Last IP-address
			* @var string
		*/
		public $last_ip;
		
		/**
			* Is online
			* @var boolean
			* @deprecated
		*/
		public $online;
		
		/**
			* Preferred language
			* @var string
		*/
		public $language;
		
		/**
			* Time of signup
			* @var time
		*/
		public $signupDate;
		
		/**
			* Time of last collab being started
			* @var time
		*/
		public $lastCollab;
		
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
			@deprecated
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