<?php
	$id = $_GET["id"];
	//
	$collab = new collab($id);
	if($collab -> owner -> name != $_USER -> name)	{
		die(header("Location: mystuff.php?error=notmine"));
	}
	//
	$success = false;
	if(isset($_POST["success"]) and $_POST["success"] == "true")	{
		$success = true;
		$url = $_POST["url"];
		$desc = $_POST["desc"];
		$members = $collab -> founder . "," . implode(",", $collab -> members["people"]);
		print_array($collab);
	}
	//
	$collab -> close();
	if($success == true)	{
		$_MYSQL -> set("INSERT INTO `featured_collab`(`name`,`desc`,`img`,`mitglieder`,`url`) VALUES(?,?,?,?,?)", array(
			$collab -> name,
			$desc,
			"http://cdn.scratch.mit.edu/get_image/project/" . $url . "_144x108.png",
			$members,
			"http://scratch.mit.edu/projects/" . $url
		));
		header("Location: index.php?result=closedandshow");
	}
	else	{
		header("Location: mystuff.php?result=closed");
	}
?>