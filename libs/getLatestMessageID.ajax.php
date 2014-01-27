<?php
	header("Content-type: text/html;charset='UTF-8'");
	require_once("../includes/db.php");
	require_once("../includes/classes.php");
	
	// Fake $_MYSQL because including loader.php fails here
	$_MYSQL = new mysqlConn;
	
	//Get latests ID
	$id = $_MYSQL -> get("SELECT MAX(id) FROM collabmessages");
	echo $id[0][0];
?>