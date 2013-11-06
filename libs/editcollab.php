<?php
	$id = mysql_real_escape_string($_GET["id"]);
	$name = mysql_real_escape_string($_POST["name"]);
	$desc = mysql_real_escape_string($_POST["desc"]);
	//
	if($name == "" or $desc == "")	{
		die(header("Location: admin.php?id=$id&error=emptyfields"));
	}
	if(isset($_FILES["logo"]) and $_FILES["logo"]["name"] != "")	{
		print_array($_FILES);
		$logo = $_FILES["logo"];
		if($logo["size"] > 100000)	{
			die(header("Location: admin.php?id=$id&error=toobig"));
		}
		if($logo["type"] != "image/png" and $logo["type"] != "image/jpeg" and $logo["type"] != "image/gif")	{
			die(header("Location: admin.php?id=$id&error=badmimetype"));
		}
		move_uploaded_file($logo["tmp_name"], "logos/".$id.".png");
		mysql_query("UPDATE `collabs` SET `logo`='".$id.".png' WHERE id='".$id."'") or die(mysql_error());
	}
	mysql_query("UPDATE `collabs` SET `desc`='$desc', `name`='$name' WHERE `id`='{$id}'");
	header("Location: admin.php?id=$id&result=editok");
?>