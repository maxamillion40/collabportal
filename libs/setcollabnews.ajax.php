<?php
	require_once("../includes/loader.php");
	
	// Load variables
	if(isset($_GET["cid"]))	{
		$collab = new collab($_GET["cid"]);
	}
	if(isset($_POST["news"]))	{
		$v = trim(strip_tags($_POST["news"]));
	}
	
	// Die if variable missing
	if(!isset($collab) || !isset($v))	{
		die(header("HTTP/1.1 400 Bad Request"));
	}
	
	// Only allow collab founder
	if($collab -> member_rank($_USER -> name) != "founder")	{
		die(header("HTTP/1.1 403 Forbidden"));
	}
	
	// Save new announcements
	$_MYSQL -> set("UPDATE `collabs` SET `announcement`=? WHERE `id`=?", array($v, $collab -> id));
	
	// Return
	echo $v;
?>