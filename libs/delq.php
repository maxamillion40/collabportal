<?php
	$id = $_GET["id"];
	$_MYSQL -> set("DELETE FROM `faq` WHERE `id`=?", array($id));
	header("Location: maintenance/faq.php?result=delqok");
?>