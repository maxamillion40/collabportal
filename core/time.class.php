<?php
	/**
		* Create, display and format unix timestamps
		* @package core
		* @since 2014-08-20
	*/
	class time	{
		/**
			* Stores the unix timestamp
			* @var int
		*/
		private $stamp;
		
		/**
			* Constructor.
			* @param null|int $int Optional, provide it if you want to work with an existing timestamp
			* @return void
		*/
		public function __construct($int = null)	{
			if(!isset($int))	{
				$int = time();
			}
			$this -> stamp = (int) $int;
		}
		
		/**
			* Format and return the timestamp as string
			* @param string $pattern See http://de2.php.net/manual/en/function.date.php
			* @return string
		*/
		public function format($pattern)	{
			if(is_string($pattern))	{
				return date($pattern, $this -> stamp);
			}
			else	{
				trigger_error("Bad argument #1 to time::format(), string expected, got " . gettype($pattern), E_USER_ERROR);
			}
		}
		
		/**
			* Get the raw timestamp
			@return int
		*/
		public function get_raw()	{
			return $this -> stamp;
		}
		
		/**
			* Format and print the timestamp
			@param string $pattern See http://de2.php.net/manual/en/function.date.php
			@return void
		*/
		public function printas($pattern)	{
			if(is_string($pattern))	{
				echo date($pattern, $this -> stamp);
			}
			else	{
				trigger_error("Bad argument #1 to time::format(), string expected, got " . gettype($pattern), E_USER_ERROR);
			}
		}
	}
?>