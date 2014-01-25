<?php
	$msgid	= $_GET["msg"];
	$collab	= $_GET["collab"];
	$_MYSQL -> set("UPDATE collabmessages SET `censored`='1' WHERE `id`=?", array($msgid));
	header("Location: collab.php?id=$collab&result=censored");
?>