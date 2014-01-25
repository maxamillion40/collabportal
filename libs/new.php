<?php
	$collabname = $_POST["collabname"];
	$desc = $_POST["desc"];
	$time = new time();
	$owner = $_USER -> name;
	$members = serialize(array(
		"founder" => $owner,
		"people" => array(),
		"candidates" => array()
	));
	//
	if($collabname == "" or $desc == "")	{
		die(header("Location: new.php?error=emptyfields"));
	}
	//
	$_MYSQL -> set("INSERT INTO `collabs`(`name`,`owner`,`desc`,`mitglieder`,`start`) VALUES(?,?,?,?,?)", array(
		$collabname,
		$owner,
		$desc,
		$members,
		$time -> stamp
	));
	header("Location: mystuff.php?result=collabok");
?>