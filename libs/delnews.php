<?php
	//Get data
	$id = $_GET["id"];
	$_MYSQL -> set("DELETE FROM `news` WHERE `id`=?", array($id));
	header("Location: maintenance/news.php?result=delnewsok");
?>