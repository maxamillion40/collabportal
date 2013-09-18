<?php
	include_once("includes/func.php");
	mysql_auto_connect();
	
	//Get data
	$username	= mysql_real_escape_string($_POST["name"]);
	$password	= md5(mysql_real_escape_string($_POST["pass"]));
	$pass_ctrl	= mysql_get("SELECT `pass` FROM `users` WHERE name='$username'")[0]["pass"];
	$return_to	= $_GET["return"] or "";
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
		header("Location: ".$return_to."?result=login");
	}
	else	{
		//wrong password
		die(header("Location: index.php?uname=$username&error=badpass"));
	}
?>