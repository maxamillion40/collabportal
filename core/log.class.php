<?php
	/**
		* Reading and writing data from the log.
		* @package core
		* @since 2014-08-27
	*/
	class log	{
		/**
			* Holds the log's data.
			* @var array
		*/
		private $data = null;
		
		/**
			* Load log data from database
			* @return void
		*/
		public function load()	{
			global $_MYSQL;
			$this -> data = $_MYSQL -> get("SELECT * FROM `logdata`");
		}
		
		/**
			* Check if the log data has been loaded successfully.
			* @return boolean
		*/
		public function is_ready()	{
			return $this -> data != null;
		}
		
		/**
			* Get the number of entries in the log table.
			* @return int
			* @api
		*/
		public function getLength()	{
			return count($this -> data);
		}
		
		/**
			* Get the size of the log in bytes
			* @return int
			* @api
		*/
		public static function getSize()	{
			global $_MYSQL;
			return $_MYSQL -> get("SELECT round(((data_length + index_length)), 2) 'bytes' FROM information_schema.TABLES WHERE table_schema = 'scratchcollabs' AND table_name = 'logdata';")[0]["bytes"];
		}
	}
?>