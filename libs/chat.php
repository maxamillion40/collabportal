<?php
	//Get data
	$collab	= $_GET["id"];
	$msg	= $_POST["msg"];
	$von	= $_USER -> name,
	$time	= time();
	//Prepare message
	$msg = trim($msg);
	$msg = str_replace(":)","<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-smile.gif\" alt=\":)\" />",$msg);
	$msg = str_replace(":(","<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\":(\" />", $msg);
	$msg = str_replace(";)", "<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\";)\" />",$msg);
	$msg = str_replace(":P", "<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-tongue-out.gif\" alt=\":P\" />",$msg);
	$msg = str_replace(":O","<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\":O\" />",$msg);
	$msg = str_replace(":D","<img src=\"http://cbeta.scratchcollabs.pf-control.de/scripts/tinymce/plugins/emoticons/img/smiley-laughing.gif\" alt=\":D\" />",$msg);
	//Check data
	if($msg == "")	{
		die(header("Location: collab.php?id=$collab&error=notext"));
	}
	if($collab == "")	{
		die(header("Location: index.php?error=noid"));
	}
	//Insert message into db
	$_MYSQL -> set("INSERT INTO `collabmessages`(`timestamp`,`absender`,`collab`,`message`) VALUES(?,?,?,?)", array(
		$time,
		$von,
		$collab,
		$msg
	));
	//Back to collab page
	header("Location: collab.php?id=$collab&result=msgok#livechat");
?>