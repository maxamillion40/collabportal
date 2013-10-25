<?php
	$id = mysql_real_escape_string($_GET["id"]);
	$msg = mysql_get("SELECT `id`,`to` FROM `messages` WHERE `id`='$id'");
	if($msg[0]["to"] == $_SESSION["user"])	{
		mysql_query("DELETE FROM `messages` WHERE `id`=$id");
		header("Location: messages.php?result=delok");
	}
	else	{
		header("Location: messages.php?error=notyours");
	}
?>