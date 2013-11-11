<?php
	session_start();
	include_once("../includes/func.php");
	header("Content-type: application/json;charset='UTF-8'");
	mysql_auto_connect();
	//Get id
	$collab = $_GET["id"];
	//Read messages for this collab
	$messages	= mysql_get("SELECT * FROM collabmessages WHERE `collab`='$collab' ORDER BY `timestamp` DESC");
	//Create an array to translate the days of the week
	$tage	= array();
		$tage["Monday"] = "Montag";
		$tage["Tuesday"] = "Dienstag";
		$tage["Wednesday"] = "Mittwoch";
		$tage["Thursday"] = "Donnerstag";
		$tage["Friday"] = "Freitag";
		$tage["Saturday"] = "Samstag";
		$tage["Sunday"] = "Sonntag";
	//Create json array
	$output = array();
	$output["msgCount"] = count($messages);
	$output["msgList"] = $messages;
	//Print json array
	echo json_encode($output);
?>