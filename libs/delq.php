<?php
	$id = mysql_real_escape_string($_GET["id"]);
	mysql_query("DELETE FROM `faq` WHERE `id`=$id");
	header("Location: maintenance/faq.php?result=delqok");
?>