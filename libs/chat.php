<?php
	//Get data
	$collab	= mysql_real_escape_string($_GET["id"]);
	$msg	= mysql_real_escape_string($_POST["msg"]);
	$von	= $_SESSION["user"];
	$time	= time();
	//Prepare message
	$msg = trim($msg);
	$msg = str_replace(":)","<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-smile.gif\" alt=\":)\" />",$msg);
	$msg = str_replace(":(","<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\":(\" />", $msg);
	$msg = str_replace(";)", "<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\";)\" />",$msg);
	$msg = str_replace(":P", "<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-tongue-out.gif\" alt=\":P\" />",$msg);
	$msg = str_replace(":O","<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\":O\" />",$msg);
	//Check data
	if($msg == "")	{
		die(header("Location: collab.php?id=$collab&error=notext"));
	}
	if($collab == "")	{
		die(header("Location: index.php?error=noid"));
	}
	//Insert message into db
	mysql_query("INSERT INTO `collabmessages`(`timestamp`,`absender`,`collab`,`message`) VALUES('$time','$von','$collab','$msg')") or die(mysql_error());
	//Back to collab page
	header("Location: collab.php?id=$collab&result=msgok#livechat");
?>