<?php
	/*
		Diese Datei stellt die Klasse mysqlConn bereit, die objektorientierten Zugriff auf die Datenbank des CPs ermöglicht.
		Zum Auslesen der Daten wird mysqlConn::get() benutzt, in allen anderen Fällen mysqlConn::set()
	*/
	require_once("mysql.php");
	
	class mysqlConn	{
		// Properties
			private $user;
			private $pass;
			private $dbname;
			private $server;
			private $rs;
		// Methods
			// Constructor
			function __construct()	{
				$this->user = CP_DBUSER;
				$this->pass = CP_DBPASS;
				$this->server = CP_DBSERVER;
				$this->dbname = CP_DBNAME;
				$this->rs = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->dbname, $this->user, $this->pass, array(
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
				));
				$this->rs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
			}
			// Get data as array
			function get($query, $args = array())	{
				try	{
					$return = array();
					$query = $this->rs->prepare($query);
					$query->execute($args);
					return $query->fetchAll();
				}
				catch(PDOException $e)	{
					print_r($e);
				}
			}
			function set($query, $args = array())	{
				try	{
					$query = $this->rs->prepare($query);
					$query->execute($args);
				}
				catch(PDOException $e)	{
					print_r($e);
				}
			}
	}
?>