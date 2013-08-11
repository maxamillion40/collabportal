<?php
	include_once("includes/func.php");
	mysql_auto_connect();
	if(!isset($_POST))	{
		die(header("Location: index.php"));
	}
	//Get data
	$username	= mysql_real_escape_string($_POST["name"]);
	$password	= md5(mysql_real_escape_string($_POST["pass"]));
	$pass_ctrl	= mysql_get("SELECT `pass` FROM `users` WHERE name='$username'")[0]["pass"];
	//Does the user exist?
	if(count($pass_ctrl) != 1)	{
		die(header("Location: index.php?uname=$username&error=unknownuser"));
	}
	//Check password
	if($password == $pass_ctrl)	{
		//ok
		session_start();
		$_SESSION["user"] = $username;
		$_SESSION["login"] = true;
		header("Location: index.php?result=login");
	}
	else	{
		//wrong password
		die(header("Location: index.php?uname=$username&error=badpass"));
	}
?>