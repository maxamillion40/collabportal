<?php
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	//Is there a param in the URI?
	if($_SERVER["QUERY_STRING"] == "")	{
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
		if(isset($_GET["settings"]))	{
			include_once("libs/settings.php");
			exit;
		}
		if(isset($_GET["kick"]))	{
			include_once("libs/kick.php");
			exit;
		}
		if(isset($_GET["sendmessage"]))	{
			include_once("libs/sendmessage.php");
			exit;
		}
		if(isset($_GET["accept"]))	{
			include_once("libs/accept.php");
			exit;
		}
		if(isset($_GET["delete"]))	{
			include_once("libs/delete.php");
			exit;
		}
		if(isset($_GET["newquestion"]))	{	
			include_once("libs/newquestion.php");
			exit;
		}
		if(isset($_GET["new"]))	{	
			include_once("libs/new.php");
			exit;
		}
		if(isset($_GET["delnews"]))	{	
			include_once("libs/delnews.php");
			exit;
		}
		if(isset($_GET["newnews"]))	{	
			include_once("libs/newnews.php");
			exit;
		}
		header("Location: index.php?error=badaction");
	}
?>