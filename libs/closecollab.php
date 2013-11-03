<?php
	print_array($_POST);
	$id = mysql_real_escape_string($_GET["id"]);
	//
	$collab = mysql_get("SELECT * FROM `collabs` WHERE `id`=$id");
	if($collab[0]["owner"] != $_SESSION["user"])	{
		die(header("Location: mystuff.php?error=notmine"));
		echo "böse";
	}
	//
	$success = false;
	if(isset($_POST["success"]) and $_POST["success"] == "true")	{
		$success = true;
		$url = $_POST["url"];
		$desc = $_POST["desc"];
		$members = $collab[0]["mitglieder"]["founder"] . "," . implode(",", $collab[0]["mitglieder"]["people"]);
		print_array($collab);
	}
	//
	mysql_query("UPDATE `collabs` SET `status`='closed' WHERE `id`='$id'");
	if($success == true)	{
		mysql_query("INSERT INTO `featured_collab`(`name`,`desc`,`img`,`mitglieder`,`url`) VALUES('".$collab[0]["name"]."','$desc','http://cdn.scratch.mit.edu/get_image/project/".$url."_144x108.png','$members','http://scratch.mit.edu/projects/$url')");
		print_array($_POST);
		header("Location: index.php?result=closedandshow");
	}
	else	{
		header("Location: mystuff.php?result=closed");
	}
?>