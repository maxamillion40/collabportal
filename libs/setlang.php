<?php
	//Get data
	$lang = $_POST["language"];
	$_MYSQL -> set("UPDATE users SET language = ?", array($lang));
	header("Location: settings.php?result=langok");
?>