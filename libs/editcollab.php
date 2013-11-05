<?php
	$id = mysql_real_escape_string($_GET["id"]);
	$name = mysql_real_escape_string($_POST["name"]);
	$desc = mysql_real_escape_string($_POST["desc"]);
	//
	if($name == "" or $desc == "")	{
		die(header("Location: admin.php?id=$id&error=emptyfields"));
	}
	mysql_query("UPDATE `collabs` SET `desc`='$desc', `name`='$name'");
	header("Location: admin.php?id=$id&result=editok");
?>