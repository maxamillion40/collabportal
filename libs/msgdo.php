<?php
	$do = $_POST["do-what"];
	//
	if($do == "Löschen")	{
		foreach($_POST["sel"] as $id)	{
			$id = $id;
			$_MYSQL -> set("DELETE FROM `messages` WHERE `id`=?", array($id));
		}
		header("Location: inbox.php?result=delallok");
		exit;
	}
	elseif($do == "Als gelesen markieren")	{
		foreach($_POST["sel"] as $id)	{
			$_MYSQL -> set("UPDATE `messages` SET `read`='1' WHERE `id`=?", array($id));
		}
		header("Location: inbox.php?result=readallok");
		exit;
	}
?>