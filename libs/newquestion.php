<?php
	include_once("includes/func.php");
		mysql_auto_connect();
		$question = mysql_real_escape_string($_POST["question"]);
		$answer = mysql_real_escape_string($_POST["answer"]);

	mysql_query("INSERT INTO faq(`question`,`answer`,`date`) VALUES('$question','$answer','".time()."')");
		header("Location: help.php?result=qok");
		
?>