<?php
	header("Content-type: text/html;charset=UTF-8");
	session_start();
		
	if(is_dir($_SERVER["DOCUMENT_ROOT"] . "/collabs2"))	{
		set_include_path($_SERVER["DOCUMENT_ROOT"] . "/collabs2");
		$_HOME = $_SERVER["DOCUMENT_ROOT"] . "/collabs2";
	}
	elseif(is_dir($_SERVER["DOCUMENT_ROOT"] . "/collabportal"))	{
		set_include_path($_SERVER["DOCUMENT_ROOT"] . "/collabportal");
		$_HOME = $_SERVER["DOCUMENT_ROOT"] . "/collabportal";
	}
	else	{
		set_include_path($_SERVER["DOCUMENT_ROOT"]);
		$_HOME = $_SERVER["DOCUMENT_ROOT"];
	}

	require_once("locale.php");
	require_once("db.php");
	require_once("classes.php");
	
	if(isset($_SESSION["user"]))	{
		$GLOBALS["CP_USER"] = new user($_SESSION["user"]);
		$_USER = &$GLOBALS["CP_USER"];
	}
	else	{
		$_USER = new user("");
	}
	
	$GLOBALS["CP_MYSQL_CONN"] = new mysqlConn;
	$_MYSQL = &$GLOBALS["CP_MYSQL_CONN"];

	//mixed set_error_handler(callback $error_handler [, int $error_types = E_ALL | E_STRICT ]);
?>