<?php
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
		$starttime = microtime();
		//
		$rs	= mysql_query($query) or die(mysql_error());
		$return = array();
		while($row = mysql_fetch_assoc($rs))	{
			$return[] = $row;
		}
		$return = auto_unserialize($return);
		//
		$endtime = microtime();
		$_SERVER["__REQUEST_TIME"] = ($endtime - $starttime) / 1000;
		return($return);
	}
	function errnotice($code,$message) {
		if($GLOBALS["err"] == $code) {
			echo "<span class='red'><span class='result-message'><span class='message-inner'>".$message."</span></span></span>";
		}
	}
	function resnotice($code,$message) {
		if($GLOBALS["res"] == $code) {
			echo "<span class='orange'><span class='result-message'><span class='message-inner'>".$message."</span></span></span>";
		}
	}
	function print_array(array $in)	{
		echo "<pre style='width: 100%; overflow-x: scroll; border: 1px orange dotted; padding: 10px;'>";
		print_r($in);
		echo "</pre>";
	}
	function get_uri()	{
		return "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	function send_pm(array $data)	{
		if(!isset($data["sender"]) || !isset($data["to"]) || !isset($data["msg"]))	{
			die("Message header incomplete");
		}
		if(!isset($data["regard"]))	{
			$data["regard"] = "[Kein Betreff]";
		}
		mysql_query("INSERT INTO `messages`(`regard`,`date`,`sender`,`to`,`msg`) VALUES('".$data["regard"]."','".time()."','".$data["sender"]."','".$data["to"]."','".$data["msg"]."')") or die(mysql_error());
		print_array($data);
	}
	function auto_unserialize(array $in)	{
		foreach($in as &$elem)	{
			if(is_array($elem))	{
				$elem = auto_unserialize($elem);
			}
			if(is_string($elem) and @unserialize($elem))	{
				$elem = @unserialize($elem);
			}
		}
		return $in;
	}
?>