<?php
	//Get data
	$who = $_USER -> name;
	$mail = $_POST["mail"];
	$_MYSQL -> set("UPDATE `users` SET `mail`=? WHERE `name`=?", array($mail, $who));
	header("Location: settings.php?result=editok");
?>