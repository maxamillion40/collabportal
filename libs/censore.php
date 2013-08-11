<?php
	$msgid	= $_GET["msg"];
	$collab	= $_GET["collab"];
	mysql_query("UPDATE collabmessages SET `censored`='1' WHERE `id`='$msgid'") or die(mysql_error());
	header("Location: collab.php?id=$collab&result=censored");
?>