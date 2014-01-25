<?php
	//Get data
	$q = $_POST["question"];
	$a = $_POST["answer"];
	$id = $_GET["id"];
	$_MYSQL -> set("UPDATE `faq` SET `question`=?, `answer`=? WHERE `id`=?", array(
		$q,
		$a,
		$id
	));
	header("Location: maintenance/faq.php?result=answerok");
?>