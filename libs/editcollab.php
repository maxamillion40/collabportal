<?php
	$id = $_GET["id"];
	$name = $_POST["name"];
	$desc = $_POST["desc"];
	//
	if($name == "" or $desc == "")	{
		die(header("Location: admin.php?id=$id&error=emptyfields"));
	}
	//Logo upload part
	if(isset($_FILES["logo"]) and $_FILES["logo"]["name"] != "")	{
		//if no error
		if($_FILES["logo"]["error"] == 0)	{
			$logo = $_FILES["logo"];
			//Check file size 2MB
			if($logo["size"] > 2097152)	{
				die(header("Location: admin.php?id=$id&error=toobig"));
			}
			//Check mime type
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			$mime = $finfo -> file($logo["tmp_name"]);
			if($mime != "image/jpeg" and $mime != "image/gif" and $mime != "image/png")	{
				die(header("Location: admin.php?id=$id&error=badmime"));
			}
			//Move file
			move_uploaded_file($logo["tmp_name"], "logos/".$id.".png");
			$_MYSQL -> set("UPDATE `collabs` SET `logo`=? WHERE id=?", array(
				$id . ".png",
				$id
			));
		}
		else	{
			die(header("Location: admin.php?id=$id&error=fileupload&int=" . $_FILES["logo"]["error"]));
		}
	}
	$_MYSQL -> set("UPDATE `collabs` SET `desc`=?, `name`=? WHERE id=?", array(
		$desc,
		$name,
		$id
	));
	header("Location: admin.php?id=$id&result=editok");
?>