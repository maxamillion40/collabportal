<?php
	$selfclass = mysql_get("SELECT `class` FROM `users` WHERE `name`='".$_SESSION["user"]."'")[0]["class"];
	if($selfclass != "Administrator")	{
		die(header("Location: maintenance/users.php?error=badclass"));
	}
	$id = mysql_real_escape_string($_GET["id"]);
	$class = mysql_real_escape_string($_GET["class"]);
	mysql_query("UPDATE `users` SET `class`='$class' WHERE `id`='$id'");
	header("Location: maintenance/users.php?result=classok");
?>