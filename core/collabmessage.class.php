<?php
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
?>