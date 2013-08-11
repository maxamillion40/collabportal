<?php
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	//Is there a param in the URI?
	if(substr_count($_SERVER["REQUEST_URI"],"?") != 1)	{
		header("Location: index.php");
	}
	else	{
		//Check the parameter and include its script
		if(isset($_GET["signup"]))	{	
			include_once("libs/signup.php");
			exit;
		}
		if(isset($_GET["login"]))	{
			include_once("libs/login.php");
			exit;
		}
		if(isset($_GET["logout"]))	{
			include_once("libs/logout.php");
			exit;
		}
		if(isset($_GET["leave"]))	{
			include_once("libs/leave.php");
			exit;
		}
		if(isset($_GET["join"]))	{
			include_once("libs/join.php");
			exit;
		}
		if(isset($_GET["chat"]))	{
			include_once("libs/chat.php");
			exit;
		}
		if(isset($_GET["censore"]))	{
			include_once("libs/censore.php");
			exit;
		}
		header("Location: index.php?error=badaction");
	}
?>