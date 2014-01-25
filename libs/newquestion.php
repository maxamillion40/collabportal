<?php
	$question = $_POST["question"];

	$_MYSQL -> set("INSERT INTO faq(`question`,`date`) VALUES(?,?)", array(
		$question,
		time()
	));
	header("Location: help.php?result=qok");	
?>