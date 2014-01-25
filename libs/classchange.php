<?php
	if($_USER -> class != "Administrator")	{
		die(header("Location: maintenance/users.php?error=badclass"));
	}
	$id = $_GET["id"];
	$class = $_GET["class"];
	$_MYSQL -> set("UPDATE `users` SET `class`=? WHERE `id`=?", array($class, $id));
	header("Location: maintenance/users.php?result=classok");
?>