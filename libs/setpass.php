<?php
	//Get data
	$who = $_USER -> name;
	$realpw = $_MYSQL -> get("SELECT `pass` FROM `users` WHERE `name`=?", array($who));
	$old = md5($_POST["old"]);
	$new = md5($_POST["new"]);
	$new2 = md5($_POST["new-2"]);
	if($old != "" and $new != "" and $new2 != "")	{
		if($new == $new2)	{
			if($old == $realpw[0]["pass"])	{
				$_MYSQL -> set("UPDATE `users` SET `pass`=? WHERE `name`=", array($who, $new));
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