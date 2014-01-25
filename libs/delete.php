<?php
	$id = $_GET["id"];
	$msg = $_MYSQL -> get("SELECT `id`,`to` FROM `messages` WHERE `id`=?", array($id));
	if($msg[0]["to"] == $_USER -> name)	{
		$_MYSQL -> set("DELETE FROM `messages` WHERE `id`=?", array($id));
		header("Location: messages.php?result=delok");
	}
	else	{
		header("Location: messages.php?error=notyours");
	}
?>