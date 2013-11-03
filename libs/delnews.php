<?php
	//Get data
	$id = mysql_real_escape_string($_GET["id"]);
	mysql_query("DELETE FROM `news` WHERE `id`='$id'");
	header("Location: maintenance/news.php?result=delnewsok");
?>