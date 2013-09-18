<?php
	require_once("includes/func.php");
	//
	$kick	= $_GET["kick"];
	$id		= mysql_real_escape_string($_GET["id"]);
	$collab	= mysql_get("SELECT `mitglieder` FROM `collabs` WHERE `id`=$id");
	//
	if(count($collab) != 1)	{
		die(header("Location: index.php?error=badaction"));
	}
	//
	$collab[0]["mitglieder"] = unserialize($collab[0]["mitglieder"]);
	if(!in_array($kick,$collab[0]["mitglieder"]["people"]))	{
		die(header("Location: collab.php?id=$id&error=badaction"));
	}
	unset($collab[0]["mitglieder"]["people"][array_search($kick,$collab[0]["mitglieder"]["people"])]);
	//
	$collab[0]["mitglieder"] = serialize($collab[0]["mitglieder"]);
	mysql_query("UPDATE `collabs` SET `mitglieder`='".$collab[0]["mitglieder"]."' WHERE `id`='".$id."'");
	header("Location: admin.php?id=$id&result=kickok");
?>