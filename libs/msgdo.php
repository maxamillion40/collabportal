<?php
	$do = $_POST["do-what"];
	//
	if($do == "Löschen")	{
		foreach($_POST["sel"] as $id)	{
			$id = mysql_real_escape_string($id);
			mysql_query("DELETE FROM `messages` WHERE `id`='$id'");
		}
		header("Location: messages.php?result=delallok");
		exit;
	}
	elseif($do == "Als gelesen markieren")	{
		foreach($_POST["sel"] as $id)	{
			$id = mysql_real_escape_string($id);
			mysql_query("UPDATE `messages` SET `read`='1' WHERE `id`='$id'");
		}
		header("Location: messages.php?result=readallok");
		exit;
	}
?>