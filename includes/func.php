﻿<?php
	function mysql_auto_connect()	{
		$db = mysql_connect("localhost","root","");
		mysql_select_db("scratchcollabs");
		mysql_set_charset("utf8",$db);
	}
	function is_loggedin()	{
		if(isset($_SESSION) && !empty($_SESSION["user"]) && $_SESSION["login"] == true)	{
			return true;
		}
		else	{
			return false;
		}
	}
	function mysql_get($query)	{
		$rs	= mysql_query($query) or die(mysql_error());
		$return = array();
		while($row = mysql_fetch_assoc($rs))	{
			$return[] = $row;
		}
		return($return);
	}
	function errnotice($code,$message) {
		if($GLOBALS["err"] == $code) {
			echo "<span class='red'><span class='result-message'>".$message."</span></span>";
		}
	}
	function resnotice($code,$message) {
		if($GLOBALS["res"] == $code) {
			echo "<span class='orange'><span class='result-message'>".$message."</span></span>";
		}
	}
	function print_array(array $in)	{
		echo "<pre style='width: 100%; overflow-x: scroll; border: 1px orange dotted; padding: 10px;'>";
		print_r($in);
		echo "</pre>";
	}
	function get_filename_and_query()	{
		return basename($_SERVER["SCRIPT_FILENAME"])."?".$_SERVER["QUERY_STRING"];
	}
?>