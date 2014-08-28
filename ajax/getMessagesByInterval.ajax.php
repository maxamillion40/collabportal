<?php
	require_once("../includes/loader.php");
	//
	$id		= (int) $_POST["cid"];
	$lower	= (int) $_POST["lower"];
	$upper	= (int) $_POST["upper"];
	$messages = array(
		"count" => 0,
		"list" => array()
	);
	//
	$messages["list"] = $_MYSQL -> get("SELECT * FROM `collabmessages` WHERE `collab`=? AND `internalID` BETWEEN ? AND ? ORDER BY `timestamp` ASC", array($id, $lower, $upper));
	$messages["count"] = count($messages["list"]);
	foreach($messages["list"] as $key => $msg)	{
		$messages["list"][$key]["timestamp"] = date("d.m.Y H:i", $messages["list"][$key]["timestamp"]);
	}
	//
	echo json_encode($messages);
?>