<?php
	/**
		* Static CP class for CP related functions.
		* This class mustn't be initiated. Access the properties and methods with `CP::foobar`
		* @since 2014-08-20
		* @package core
	*/
	class CP	{
		private function __construct() {}
		
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
		const GITHUB_REPO = "https://github.com/webdesigner97/collabportal";
		
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
	}
?>