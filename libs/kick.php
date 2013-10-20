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
	if(!in_array($kick,$collab[0]["mitglieder"]["people"]))	{
		die(header("Location: collab.php?id=$id&error=badaction"));
	}
	unset($collab[0]["mitglieder"]["people"][array_search($kick,$collab[0]["mitglieder"]["people"])]);
	//
	//Benachrichtigung
		$message = array(
			"sender" => "Systemnachricht",
			"to" => $kick,
			"msg" => "Du wurdest aus einem Collab geworfen!",
			"regard" => "Du wurdest gekickt!"
		);
		send_pm($message);
	$collab[0]["mitglieder"] = serialize($collab[0]["mitglieder"]);
	mysql_query("UPDATE `collabs` SET `mitglieder`='".$collab[0]["mitglieder"]."' WHERE `id`='".$id."'");
	header("Location: admin.php?id=$id&result=kickok");
?>