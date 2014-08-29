<?php
	require_once("../includes/loader.php");
	//
	$id		= (int) $_POST["cid"];
	//
	$high = $_MYSQL -> get("SELECT `internalID` FROM `collabmessages` WHERE `collab`=? ORDER BY `timestamp` DESC LIMIT 1", array($id));
	$high = $high[0];
	//
	echo json_encode($high);
?>