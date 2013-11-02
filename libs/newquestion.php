<?php
	include_once("includes/func.php");
		mysql_auto_connect();
		$question = mysql_real_escape_string($_POST["question"]);

	mysql_query("INSERT INTO faq(`question`,`date`) VALUES('$question','".time()."')");
		header("Location: help.php?result=qok");
		
?>