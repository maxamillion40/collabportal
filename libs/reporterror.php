<?php
	$username = $_POST["username"];
	$time = $_POST["time"];
	$error = $_POST["error"];
	$browser = $_POST["browser"];
	$notes = $_POST["notes"] or "---none---";
	
	$headers = array();
	$headers[] = "From: noreply@scratchcollabs.pf-control.de";
	
	mail(CP_ADMINS_MAIL, "ScratchHub script error", "
		Hello webdesigner97 and Lirex!
		$username just triggered an error on ScratchHub ($time).
		The error message reads as follows: $error.
		$username uses the following browser: $browser.
		
		These are the notes $username gives you:
		$notes
	", implode("\r\n", $headers));
	
	header("Location: index.php?result=errorreported");
?>