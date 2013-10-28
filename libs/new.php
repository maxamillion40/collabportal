<?php
	$collabname = mysql_real_escape_string($_POST["collabname"]);
	$desc = mysql_real_escape_string($_POST["desc"]);
	$time = time();
	$owner = $_SESSION["user"];
	$members = serialize(array(
		"founder" => $_SESSION["user"],
		"people" => array(),
		"candidates" => array()
	));
	//
	if($collabname == "" or $desc == "")	{
		die(header("Location: new.php?error=emptyfields"));
	}
	//
	mysql_query("INSERT INTO `collabs`(`name`,`owner`,`desc`,`mitglieder`,`start`) VALUES('$collabname','$owner','$desc','$members','$time')");
	header("Location: mystuff.php?result=collabok");
?>