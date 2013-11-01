<?php
	//Get data
	$headline = mysql_real_escape_string($_POST["headline"]);
	$msg = mysql_real_escape_string($_POST["msg"]);
	$pic = mysql_real_escape_string($_POST["pic"]);
	$time = time();
	mysql_query("INSERT INTO `news`(`pic`,`date`,`headline`,`msg`) VALUES('icon_$pic.png','$time','$headline','$msg')");
	header("Location: maintenance.php?result=newsok");
?>