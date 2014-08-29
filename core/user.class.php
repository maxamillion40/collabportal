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
			* Is this user logged in?
			* @var boolean
		*/
		private $valid;
		
		/**
			* Constructor.
			* @param string|null $name Username, leave empty when constructing a non-logged in user
			* @return void
		*/
		
		public function __construct($name = null)	{
			global $_MYSQL;
			// If $name is null, it's a non-registered user (Guest)
			if($name != null)	{
				$data = $_MYSQL -> get("SELECT * FROM users WHERE name=?",array($name));
				// The databse must return exactly one set of data. Everything different would be fatal!
				if(count($data) == 1)	{
					$this -> id 		= (int) $data[0]["id"];
					$this -> name 		= (string) $data[0]["name"];
					$this -> pass 		= (string) $data[0]["pass"];
					$this -> mail 		= (string) $data[0]["mail"];
					$this -> scratch 	= (string) $data[0]["scratch"];
					$this -> class 		= (int) $data[0]["class"];
					$this -> last_login	= (int) $data[0]["last_login"];
					$this -> last_ip 	= (string) $data[0]["last_ip"];
					$this -> valid	 	= (boolean) true;
					$this -> language 	= (string) $data[0]["language"];
					$this -> signupDate	= (object) new time((int) $data[0]["signup"]);
					$this -> lastCollab	= (object) new time((int) $data[0]["lastcollab"]);
				}
				else	{
					$this -> valid = false;
				}
			}
			else	{
				$this -> id = null;
				$this -> name = "Unknown user";
				$this -> pass = null;
				$this -> mail = null;
				$this -> scratch = null;
				$this -> class = CP::USER_GUEST;
				$this -> last_login = null;
				$this -> last_ip = $_SERVER["REMOTE_ADDR"];
				$this -> valid = false;
			}
		}
		
		/**
			* Check if the user is online.
			* @return boolean
			* @deprecated
			* @api
		*/
		public function is_online()	{
			return $this -> isLoggedIn();
		}
		
		/**
			* Check if user is logged in
			* @return boolean
			* @api
		*/
		public function isLoggedIn()	{
			return $this -> valid == true;
		}
	}
?>