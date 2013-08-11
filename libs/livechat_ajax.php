<?php
	session_start();
	include_once("../includes/func.php");
	mysql_auto_connect();
	//Get id
	$collab = $_GET["id"];
	//Read messages for this collab
	$messages	= mysql_get("SELECT * FROM collabmessages WHERE `collab`='$collab' ORDER BY `timestamp` DESC");
	//Create an array to translate the days of the week
	$tage	= array();
		$tage["Monday"] = "Montag";
		$tage["Tuesday"] = "Dienstag";
		$tage["Wednesday"] = "Mittwoch";
		$tage["Thursday"] = "Donnerstag";
		$tage["Friday"] = "Freitag";
		$tage["Saturday"] = "Samstag";
		$tage["Sunday"] = "Sonntag";
	//echo all messages
	if(count($messages) > 0)	{
		foreach($messages as $msg)	{
			if(!$msg["censored"])	{
				echo "<div class='msg msgid-".$msg["id"]."'>";
				echo "<div class='msghead'>";
					echo "<button onClick='javascript: navigate(\"action.php?censore&collab=".$collab."&msg=".$msg["id"]."\");' class='censore-button' title='Zensieren'>X</button> ".$msg["absender"]." am ".$tage[date("l",$msg["timestamp"])].", ".date("d.m.Y h:i",$msg["timestamp"]);
					echo "</div>";
				echo "<div class='msgbody'>";
					echo $msg["message"];
				echo "</div>";
				echo "</div>";
			}
			else	{
				echo "<div class='msg msgid-".$msg["id"]."'>";
				echo "<div class='msg-head'>";
					echo $msg["absender"]." am ".$tage[date("l",$msg["timestamp"])].", ".date("d.m.Y h:i",$msg["timestamp"]);
					echo "</div>";
				echo "<div class='msg-body'>";
					echo "<span style='font-style: italic;'>Diese Nachricht wurde vom Collabgründer zensiert.";
				echo "</div>";
				echo "</div>";
			}
		}
	}
	else	{
		echo "Keine Nachrichten vorhanden!";
	}
?>