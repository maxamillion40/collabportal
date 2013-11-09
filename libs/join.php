<?php
	$who		= $_SESSION["user"];
	$id			= mysql_real_escape_string($_GET["id"]);
	$members	= mysql_get("SELECT mitglieder FROM collabs WHERE id='".$id."'");
	$settings	= mysql_get("SELECT settings FROM collabs WHERE id='".$id."'");
	$name		= mysql_get("SELECT `name` FROM collabs WHERE id='".$id."'");
	//
	if(in_array($who,$members[0]["mitglieder"]["people"]) or $members[0]["mitglieder"]["founder"] == $who)	{
		header("Location: collab.php?id=".$_GET["id"]."&error=alreadyin");
	}
	else	{
		//Muss Beitritt bestätigt werden?
		if($settings[0]["settings"]["confirm_join"] == true)	{
			$members[0]["mitglieder"]["candidates"][] = $who;
			//Benachrichtigung
			$message = array(
				"sender" => "Systemnachricht",
				"to" => $members[0]["mitglieder"]["founder"],
				"msg" => "$who möchte deinem Collab <a href='collab.php?id=$id'>".$name[0]["name"]."</a> beitreten!",
				"regard" => "$who hat sich für ".$name[0]["name"]." beworben"
			);
			send_pm($message);
			$members = serialize($members[0]["mitglieder"]);
			mysql_query("UPDATE collabs SET `mitglieder`='$members' WHERE `id`='".mysql_real_escape_string($_GET["id"])."'") or die(mysql_error());
			header("Location: collab.php?id=".$_GET["id"]."&result=applicationok");
		}
		else	{
			$members[0]["mitglieder"]["people"][] = $who;
			//Benachrichtigung
			$message = array(
				"sender" => "Systemnachricht",
				"to" => $members[0]["mitglieder"]["founder"],
				"msg" => "$who ist deinem Collab <a href=\"collab.php?id=$id\">".$name[0]["name"]."</a> beigetreten!",
				"regard" => "$who ist ".$name[0]["name"]." beigetreten!"
			);
			send_pm($message);
			$members = serialize($members[0]["mitglieder"]);
			mysql_query("UPDATE collabs SET `mitglieder`='$members' WHERE `id`='".mysql_real_escape_string($_GET["id"])."'") or die(mysql_error());
			header("Location: collab.php?id=".$_GET["id"]."&result=joinok");
		}
	}
?>