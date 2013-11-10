<?php
	//Get data
	$collab	= mysql_real_escape_string($_GET["id"]);
	$msg	= mysql_real_escape_string($_POST["msg"]);
	$von	= $_SESSION["user"];
	$time	= time();
	//Check data
	if($msg == "")	{
		die(header("Location: collab.php?id=$collab&error=notext"));
	}
	if($collab == "")	{
		die(header("Location: index.php?error=noid"));
	}
	//Insert message into db
	mysql_query("INSERT INTO `collabmessages`(`timestamp`,`absender`,`collab`,`message`) VALUES('$time','$von','$collab','$msg')");
	//Back to collab page
	header("Location: collab.php?id=$collab&result=msgok#livechat");
?>