<?php
	$who		= $_SESSION["user"];
	$members	= mysql_get("SELECT mitglieder FROM collabs WHERE id='".$_GET["id"]."'")[0]["mitglieder"];
	//
	if(in_array($who,$members["people"]) or $members["founder"] == $who)	{
		echo "Du bist schon drin!";
		header("Location: collab.php?id=".$_GET["id"]."&error=alreadyin");
	}
	else	{
		echo "Du bist nicht drin!";
		$members["people"][] = $who;
		//Benachrichtigung
		$message = array(
			"sender" => "Systemnachricht",
			"to" => $members["founder"],
			"msg" => "$who ist nun Mitglied in deinem Collab X",
			"regard" => "$who ist deinem Collab beigetreten!"
		);
		send_pm($message);
		$members = serialize($members);
		mysql_query("UPDATE collabs SET `mitglieder`='$members' WHERE `id`='".mysql_real_escape_string($_GET["id"])."'") or die(mysql_error());
		header("Location: collab.php?id=".$_GET["id"]."&result=joinok");
	}
?>