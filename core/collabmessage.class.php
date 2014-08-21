<?php
	/**
		* Class for collab messages
		* @package core
		* @since 2014-08-20
	*/
	class collabmessage extends message	{
		/**
			* Name of the user who sent the message
			* @var string
		*/
		var $sender;
		
		/**
			* Indicates wheter the message was censored
			* @var boolean
		*/
		var $censored;
		
		/**
			* ID of the message in this collab
			* @var int
		*/
		var $internalID;
		
		/**
			* Constructor.
			* @param int $id Pass an existing message ID to it
			* @return void
		*/
		function __construct($id = null)	{
			if(isset($id))	{
				global $_MYSQL;
				$data = $_MYSQL -> get("SELECT * FROM collabmessages WHERE `id`=?", array($id));
				$this -> id = $data[0]["id"];
				$this -> date = new time($data[0]["timestamp"]);
				$this -> sender = new user($data[0]["absender"]);
				$this -> to = new collab($data[0]["collab"]);
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
?>