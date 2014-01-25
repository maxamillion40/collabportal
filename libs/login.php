<?php
	//include_once("includes/func.php");
	//mysql_auto_connect();
	
	require_once("includes/loader.php");
	
	//Get data
	$username	= ucfirst($_POST["name"]);
	$password	= md5($_POST["pass"]);
	$user		= new user($username);
	$return_to	= $_GET["return"] or "";
	if(strstr($return_to,"?"))	{
		$return_to .= "&result=login";
	}
	else	{
		$return_to .= "?result=login";
	}
	//Does the user exist?
	if($user -> name == "")	{
		die(header("Location: index.php?uname=$username&error=unknownuser"));
	}
	//Check password
	if($password == $user -> pass)	{
		if($user -> class != "Banned")	{
			//ok
			$_SESSION["user"] = $username;
			$_USER -> online = true;
			$_MYSQL -> set("UPDATE `users` SET `last_login`='".time()."', `last_ip`='".$_SERVER["REMOTE_ADDR"]."' WHERE `name`='$username'");
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