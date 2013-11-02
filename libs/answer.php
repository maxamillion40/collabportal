<?php
	//Get data
	$q = mysql_real_escape_string($_POST["question"]);
	$a = mysql_real_escape_string($_POST["answer"]);
	$id = mysql_real_escape_string($_GET["id"]);
	mysql_query("UPDATE `faq` SET `question`='$q', `answer`='$a' WHERE `id`='$id'");
	header("Location: maintenance.php?result=answerok");
?>