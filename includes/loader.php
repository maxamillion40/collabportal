<?php
	header("Content-type: text/html;charset=UTF-8");
	session_start();
	
	//Get the home path of the CollabPortal. It varies on the server <-> local installations
	if(is_dir($_SERVER["DOCUMENT_ROOT"] . "/collabportal"))	{
		set_include_path($_SERVER["DOCUMENT_ROOT"] . "/collabportal");
		$_HOME = $_SERVER["DOCUMENT_ROOT"] . "/collabportal";
	}
	else	{
		set_include_path($_SERVER["DOCUMENT_ROOT"]);
		$_HOME = $_SERVER["DOCUMENT_ROOT"];
	}
	
	//Load additional modules
	require_once("core/classes.php");
	require_once("db.php");
	
	//Define $_USER
	if(isset($_SESSION["user"]))	{
		$GLOBALS["CP_USER"] = new user($_SESSION["user"]);
		$_USER = &$GLOBALS["CP_USER"];
	}
	else	{
		$_USER = new user("");
	}
	
	//Load even more modules
	require_once("locale.php");
	require_once("scripts.php");
	require_once("errorhandling.php");
	
	//Define $_MYSQL and $_PAGE
	$_MYSQL = new mysqlConn;
	$_PAGE = new page;
?>