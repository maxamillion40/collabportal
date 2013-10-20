<?php
	$who		= $_SESSION["user"];
	$id			= mysql_real_escape_string($_GET["id"]);
	$members	= mysql_get("SELECT mitglieder FROM collabs WHERE id='$id'")[0]["mitglieder"];
	if($members["founder"] == $who)	{
		header("Location: collab.php?id=".$id."&error=own");
	}
	elseif(!in_array($who,$members["people"]))	{
		header("Location: collab.php?id=".$id."&error=notin");
	}
	else	{
		unset($members["people"][array_search($who,$members["people"])]);
		//Benachrichtigung
		$message = array(
			"sender" => "Systemnachricht",
			"to" => $members["founder"],
			"msg" => "$who hat dein Collab X verlassen",
			"regard" => "$who hat dein Collab verlassen!"
		);
		send_pm($message);
		$members	= serialize($members);
		mysql_query("UPDATE collabs SET `mitglieder`='$members' WHERE `id`='$id'");
		if(isset($_GET["red"])) {
			header("Location: mystuff.php?result=leaveok");
		}
		else {
			header("Location: collab.php?id=".$id."&result=leaveok");
		}
	}
?>