<?php
	$id = $_GET["id"];
	$name = $_POST["name"];
	$desc = $_POST["desc"];
	//
	if($name == "" or $desc == "")	{
		die(header("Location: admin.php?id=$id&error=emptyfields"));
	}
	if(isset($_FILES["logo"]) and $_FILES["logo"]["name"] != "")	{
		if($_FILES["logo"]["error"] == 0)	{
			$logo = $_FILES["logo"];
			$info = getimagesize($logo["tmp_name"]);
			if($logo["size"] > 2097152)	{
				die(header("Location: admin.php?id=$id&error=toobig"));
			}
			if($logo["type"] != "image/png" and $logo["type"] != "image/jpeg" and $logo["type"] != "image/gif")	{
				die(header("Location: admin.php?id=$id&error=badmimetype&mime=".$logo["type"]));
			}
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