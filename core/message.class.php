<?php
	/**
		* Class for system messages
		* @package core
		* @since 2014-08-20
	*/
	class message	{
		/**
			* Message ID as known in the database
			* @var int
		*/
		var $id;
		
		/**
			* Name of the user the message has been sent/ will be sent to
			* @var string
		*/
		var $to;
		
		/**
			* Date of message creation
			* @var time
		*/
		var $date;
		
		/**
			* Message subject
			* @var string
		*/
		var $regard;
		
		/**
			* Message content
			* @var string
		*/
		var $msg;
		
		/**
			* Indicates whether the message has already been read
			* @var boolean
		*/
		var $read;
		
		/**
			* Constructor.
			* @param int $id Pass an existing message ID to it
			* @return void
		*/
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
		
		/**
			* Checks whether all required data for this message has been set.
			* @return void
			* @deprecated
		*/
		public function can_send()	{
			if(isset($this -> sender) && isset($this -> to) && isset($this -> regard) && isset($this -> msg))	{
				return true;
			}
			else	{
				return false;
			}
		}
		
		/**
			* Save message to database
			* @return void
		*/
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
?>