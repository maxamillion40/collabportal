<?php
	header("Content-type: text/html;charset='UTF-8'");
	require_once("../includes/db.php");
	require_once("../includes/classes.php");
	
	// Fake $_MYSQL because including loader.php fails here
	$_MYSQL = new mysqlConn;
	
	// Read variables
	$lastID = $_GET["lastID"];
	$cid	= $_GET["cid"];
	$ids 	= $_MYSQL -> get("SELECT id FROM collabmessages WHERE collab = ? AND internalID >= ? ORDER BY internalID DESC LIMIT 10", array($cid, $lastID));
	$messages = array();
	foreach($ids as $id)	{
		$messages[] = new collabmessage($id[0]);
	}
	//$messages = array_reverse($messages);
	foreach($messages as $msg)	{
		echo "<div class='msg msg-" . $msg -> id . "'>";
		echo "<div class='msg-head'>";
		echo $msg -> sender -> name . " am " . $msg -> time -> format("d.m.Y H:i:s");
		echo "</div>";
		echo "<div class='msg-head'>";
		echo $msg -> msg;
		echo "</div>";
		echo "</div>";
	}
?>