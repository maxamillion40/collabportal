<?php
	include_once("includes/func.php");
	mysql_auto_connect();
	
	//Get data
	$username	= mysql_real_escape_string($_POST["name"]);
	$password	= md5(mysql_real_escape_string($_POST["pass"]));
	$pass_ctrl	= mysql_get("SELECT `pass` FROM `users` WHERE `name`='$username'");
	$class = mysql_get("SELECT `class` FROM `users` WHERE `name`='$username'");
	$return_to	= $_GET["return"] or "";
	if(strstr($return_to,"?"))	{
		$return_to .= "&result=login";
	}
	else	{
		$return_to .= "?result=login";
	}
	//Does the user exist?
	if(count($pass_ctrl) != 1)	{
		die(header("Location: index.php?uname=$username&error=unknownuser"));
	}
	//Check password
	if($password == $pass_ctrl[0]["pass"])	{
		if($class[0]["class"] != "Banned")	{
			//ok
			session_start();
			$_SESSION["user"] = $username;
			$_SESSION["login"] = true;
			mysql_query("UPDATE `users` SET `last_login`='".time()."', `last_ip`='".$_SERVER["REMOTE_ADDR"]."' WHERE `name`='$username'");
			header("Location: ".$return_to);
		}
		else	{
			header("Location: index.php?error=banned");
		}
	}
	else	{
		//wrong password
		die(header("Location: index.php?uname=$username&error=badpass"));
	}
?>