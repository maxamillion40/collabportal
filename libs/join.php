<?php
	$who		= $_SESSION["user"];
	$id			= mysql_real_escape_string($_GET["id"]);
	$members	= mysql_get("SELECT mitglieder FROM collabs WHERE id='".$id."'")[0]["mitglieder"];
	$settings	= mysql_get("SELECT settings FROM collabs WHERE id='".$id."'")[0]["settings"];
	$name		= mysql_get("SELECT `name` FROM collabs WHERE id='".$id."'")[0]["name"];;
	//
	if(in_array($who,$members["people"]) or $members["founder"] == $who)	{
		echo "Du bist schon drin!";
		header("Location: collab.php?id=".$_GET["id"]."&error=alreadyin");
	}
	else	{
		echo "Du bist nicht drin!";
		//Muss Beitritt bestätigt werden?
		if($settings["confirm_join"] == true)	{
			$members["candidates"][] = $who;
			//Benachrichtigung
			$message = array(
				"sender" => "Systemnachricht",
				"to" => $members["founder"],
				"msg" => "$who möchte deinem Collab <a href='collab.php?id=$id'>$name</a> beitreten!",
				"regard" => "$who hat sich für $name beworben"
			);
			send_pm($message);
			$members = serialize($members);
			mysql_query("UPDATE collabs SET `mitglieder`='$members' WHERE `id`='".mysql_real_escape_string($_GET["id"])."'") or die(mysql_error());
			header("Location: collab.php?id=".$_GET["id"]."&result=applicationok");
		}
		else	{
			$members["people"][] = $who;
			//Benachrichtigung
			$message = array(
				"sender" => "Systemnachricht",
				"to" => $members["founder"],
				"msg" => "$who ist deinem Collab <a href=\"collab.php?id=$id\">$name</a> beigetreten!",
				"regard" => "$who ist $name beigetreten!"
			);
			send_pm($message);
			$members = serialize($members);
			mysql_query("UPDATE collabs SET `mitglieder`='$members' WHERE `id`='".mysql_real_escape_string($_GET["id"])."'") or die(mysql_error());
			header("Location: collab.php?id=".$_GET["id"]."&result=joinok");
		}
	}
?>