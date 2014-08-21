<?php
	/**
		* This class is used for database access.
		* It doesn't need to be initiated when you need it, just use `$_MYSQL`.
		* @since 2014-08-20
		* @package core
	*/
	
	class mysqlConn	{
		// Properties
			/**
				* Database resource.
				* @return void
			*/
			private $rs;
		// Methods
			/**
				* Constructor.
				* @return void
			*/
			function __construct()	{
				$this -> user = CP::DB_USER;
				$this -> pass = CP::DB_PASS;
				$this -> server = CP::DB_SERVER;
				$this -> dbname = CP::DB_NAME;
				$this -> rs = new PDO("mysql:host=" . CP::DB_SERVER . ";dbname=" . CP::DB_NAME, CP::DB_USER, CP::DB_PASS, array(
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
				));
				$this -> rs -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
			}
			
			/**
				* Read data from the database.
				* Used to read data with the `SELECT` command
				* @return array
				* @throws PDOException if there is a MySQL error
			*/
			public function get($query, $args = array())	{
				try	{
					$return = array();
					$query = $this -> rs -> prepare($query);
					$query -> execute($args);
					return $query -> fetchAll();
				}
				catch(PDOException $e)	{
					print_r($e);
				}
			}
			
			/**
				* Save data into the database.
				* Used to save data with the `UPDATE`, `DELETE` and `INSERT` commands
				* @return void
				* @throws PDOException if there is a MySQL error
			*/
			function set($query, $args = array())	{
				try	{
					$query = $this -> rs -> prepare($query);
					
					$x = 1;
					foreach($args as $arg)	{
						$query -> bindValue($x, $arg);
						$x++;
					}
					
					$query -> execute($args);
				}
				catch(PDOException $e)	{
					print_r($e);
				}
			}
	}
	
	// Global mySQL Object
	$_MYSQL = new mysqlConn;
?>