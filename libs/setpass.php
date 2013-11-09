<?php
	//Get data
	$who = $_SESSION["user"];
	$realpw = mysql_get("SELECT `pass` FROM `users` WHERE `name`='$who'");
	$old = md5($_POST["old"]);
	$new = md5($_POST["new"]);
	$new2 = md5($_POST["new-2"]);
	if($old != "" and $new != "" and $new2 != "")	{
		if($new == $new2)	{
			if($old == $realpw[0]["pass"])	{
				mysql_query("UPDATE `users` SET `pass`='$new' WHERE `name`='$who'");
				header("Location: settings.php?result=editok");
			}
			else	{
				die(header("Location: settings.php?error=oldwrong"));
			}
		}
		else	{
			die(header("Location: settings.php?error=nomatch"));
		}
	}
	else	{
		die(header("Location: settings.php?error=emtpyfields"));
	}
?>