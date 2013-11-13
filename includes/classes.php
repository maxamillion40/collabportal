<?php
	function mysql_get($query, $arg=array())	{
		$conn = new PDO("mysql:host=localhost;dbname=scratchcollabs","root","",array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		));
		if(count($arg > 0))	{
			$stmt = $conn->prepare($query);
			$stmt->execute($arg);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
	}
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
			$data = mysql_get("SELECT * FROM collabs WHERE id=?",array($id));
			$this->id = $data[0]["id"];
			$this->name = $data[0]["name"];
			$this->starttime = $data[0]["start"];
			$this->members = unserialize($data[0]["mitglieder"]);
			$this->status = $data[0]["status"];
			$this->owner = $this->members["founder"];
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
				$this->members["candidates"][$this->members["candidates"][$i]] = new user($this->members["candidates"][$i]);
				unset($this->members["candidates"][$i]);
			}
		}
		public function close()	{
			// MySQL query for closing
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
		public function __construct($name)	{
			$data = mysql_get("SELECT * FROM users WHERE name=?",array($name));
			if(count($data) == 1)	{
				$this->id = $data[0]["id"];
				$this->name = $data[0]["name"];
				$this->pass = $data[0]["pass"];
				$this->mail = $data[0]["mail"];
				$this->scratch = $data[0]["scratch"];
				$this->class = $data[0]["class"];
				$this->last_login = $data[0]["last_login"];
				$this->last_ip = $data[0]["last_ip"];
			}
		}
	}
?>