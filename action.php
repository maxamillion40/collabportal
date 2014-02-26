<?php
	require_once("includes/func.php");
	require_once("includes/loader.php");
	//Is there a param in the URI?
	if($_SERVER["QUERY_STRING"] == "")	{
		header("HTTP/1.0 403");
		header("Location: error403.php?error=noaccess");
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
		if(isset($_GET["answer"]))	{	
			include_once("libs/answer.php");
			exit;
		}
		if(isset($_GET["msgdo"]))	{	
			include_once("libs/msgdo.php");
			exit;
		}
		if(isset($_GET["closecollab"]))	{	
			include_once("libs/closecollab.php");
			exit;
		}
		if(isset($_GET["delq"]))	{	
			include_once("libs/delq.php");
			exit;
		}
		if(isset($_GET["classchange"]))	{	
			include_once("libs/classchange.php");
			exit;
		}
		if(isset($_GET["editcollab"]))	{	
			include_once("libs/editcollab.php");
			exit;
		}
		if(isset($_GET["setmail"]))	{	
			include_once("libs/setmail.php");
			exit;
		}
		if(isset($_GET["setpass"]))	{	
			include_once("libs/setpass.php");
			exit;
		}
		if(isset($_GET["setlang"]))	{	
			include_once("libs/setlang.php");
			exit;
		}
		//
		header("HTTP/1.0 404");
		header("Location: error404.php?error=notfound");
	}
?>