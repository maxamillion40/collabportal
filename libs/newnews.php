<?php
	//Get data
	$headline = $_POST["headline"];
	$msg = $_POST["msg"];
	$pic = $_POST["pic"];
	$time = new time();
	$_MYSQL -> set("INSERT INTO `news`(?,?,?,?) VALUES('icon_$pic.png','$time','$headline','$msg')", array(
		"icon_$pic.png",
		$time -> stamp,
		$headline,
		$msg
	));
	header("Location: maintenance/news.php?result=newsok");
?>