<?php
	header("Content-type: text/html;charset='UTF-8'");
	require_once("../includes/db.php");
	require_once("../includes/classes.php");
	
	// Fake $_MYSQL because including loader.php fails here
	$_MYSQL = new mysqlConn;
	
	// Read variables
	$lastID = $_GET["lastID"];
	$cid	= $_GET["cid"];
	$method = $_GET["method"];
	if($method == "initial")	{
		$ids 	= $_MYSQL -> get("SELECT id FROM collabmessages WHERE collab = ? AND internalID >= ? ORDER BY internalID DESC LIMIT 10", array($cid, $lastID));
	}
	elseif($method == "repeated")	{
		$ids 	= $_MYSQL -> get("SELECT id FROM collabmessages WHERE collab = ? AND internalID <= ? ORDER BY internalID DESC LIMIT 10", array($cid, $lastID));
	}
	$messages = array();
	foreach($ids as $id)	{
		$messages[] = new collabmessage($id[0]);
	}
	//$messages = array_reverse($messages);
	foreach($messages as $msg)	{
		echo "<div class='msg msg-" . $msg -> id . "'>";
		echo "<div class='msg-head'>";
		echo "<span class='msg-name'>" . $msg -> sender -> name . "</span> am " . $msg -> time -> format("d.m.Y H:i:s");
		echo "</div>";
		echo "<div class='msg-body'>";
		echo $msg -> msg;
		echo "</div>";
		echo "</div>";
	}
?>