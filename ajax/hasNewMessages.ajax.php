<?php
	require_once("../includes/loader.php");
	//
	$id = $_POST["cid"];
	$client = $_POST["client"];
	//
	// Read IDs of messages that are newer than those the client has and return their amount
	$num = count($_MYSQL -> get("SELECT internalID FROM collabmessages WHERE collab = ? AND `internalID` > ?", array($id, $client)));
	//
	echo json_encode($num);
?>