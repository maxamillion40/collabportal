<?php
	/**
		* Static CP class for CP related functions.
		* This class mustn't be initiated. Access the properties and methods with `CP::foobar`
		* @since 2014-08-20
		* @package core
	*/
	class CP	{
		/**
			* Disabled constructor.
			* @ignore
		*/
		private function __construct() {}
		
		/**
			* Stores error messages
			* @static
			* @var array
		*/
		private static $error_messages = array();
		
		/**
			* Stores result messages
			* @static
			* @var array
		*/
		private static $result_messages = array();
		
		/**
			* The name shown in <title>
			* @const
		*/
		const NAME = "ScratchHub";
		
		/**
			* Description for <head>
			* @const
		*/
		const DESCRIPTION = "Lorem Ipsum dolor sit amet";
		
		/**
			* Comma-seperated list of keywords for <head>
			* @const
		*/
		const KEYWORDS = "scratch, collabs";
		
		/**
			* Delimiter for <title>
			* @const
		*/
		const TITLE_SPLITTER = "&raquo;";
		
		/**
			* URI to the Github repository
			* @const
		*/
		const GITHUB_REPO = "https://github.com/Collabportalteam/collabportal";
		
		/**
			* Comma-seperated list of mail addresses
			* @const
		*/
		const ADMINS_MAIL = "Christian_D_97@gmx.de, alex-zimmer@online.de";
		
		/**
			@ignore
		*/
		const BR = "\r\n";
		
		/**
			* User rank "Guest"; used for people that didn't login yet
			* @const
		*/
		const USER_GUEST = 0;
		/**
			* User rank "Member"; used for people who are logged-in
			* @const
		*/
		const USER_MEMBER = 1;
		
		/**
			* User rank "Moderators"
			* @const
		*/
		const USER_MODERATOR = 2;
		
		/**
			* User rank "Admin"
			* @const
		*/
		const USER_ADMIN = 3;
		
		/**
			* Username for the MySQL database
			* @const
		*/
		const DB_USER = "root";
		
		/**
			* Password for the database
			* @const
		*/
		const DB_PASS = "";
		
		/**
			* Database name
			* @const
		*/
		const DB_NAME = "scratchcollabs";
		
		/**
			* MySQL server
			* @const
		*/
		const DB_SERVER = "localhost";
		
		/**
			* Get the current URI.
			* @return string
		*/
		public static function get_uri()	{
			return "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		
		/**
			* Registers a new notification.
			* @param string $event Either 'error' or 'result'
			* @param string $code Event code as passed in `&error=code` and `&result=code`
			* @param string $message Notification message. Keep it as short as possible
			* @return void
			* @throws InvalidArgumentException if one or more param is missing or not of the correct type
			* @api
		*/
		public static function register_notification($event, $code, $message)	{
			if($event != "result" and $event != "error")	{
				throw new InvalidArgumentException("Bad argument #1 to CP::register_notification, string expected, got " . gettype($event));
			}
			if(!isset($code))	{
				throw new InvalidArgumentException("Bad argument #2 to CP::register_notification, string expected, got " . gettype($event));
			}
			if(!isset($message))	{
				throw new InvalidArgumentException("Bad argument #3 to CP::register_notification, string expected, got " . gettype($event));
			}
			if($event == "error")	{
				CP::$error_messages[$code] = $message;
			}
			elseif($event == "result")	{
				CP::$result_messages[$code] = $message;
			}
		}
		
		/**
			* Parse and display notifications.
			* @return void
			* @api
		*/
		public static function parse_notifications()	{
			//Results
			if(isset($_GET["result"]))	{
				foreach(CP::$result_messages as $code => $message)	{
					if($_GET["result"] == $code)	{
						echo "<span class='orange'><span class='result-message'><span class='message-inner'>" . $message . "</span></span></span>";
					}
				}
			}
			//Errors
			if(isset($_GET["error"]))	{
				foreach(CP::$error_messages as $code => $message)	{
					if($_GET["error"] == $code)	{
						echo "<span class='red'><span class='result-message'><span class='message-inner'>" . $message . "</span></span></span>";
					}
				}
			}
		}
	}
?>