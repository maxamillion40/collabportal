<?php
	//Get data
	$who = $_SESSION["user"];
	$mail = mysql_real_escape_string($_POST["mail"]);
	mysql_query("UPDATE `users` SET `mail`='$mail' WHERE `name`='$who'");
	header("Location: settings.php?result=editok");
?>