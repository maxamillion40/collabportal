<?php
	$who		= $_SESSION["user"];
	$id			= mysql_real_escape_string($_GET["id"]);
	$members	= mysql_get("SELECT mitglieder FROM collabs WHERE id='$id'")[0]["mitglieder"];
	$members	= unserialize($members);
	if($members["founder"] == $who)	{
		header("Location: collab.php?id=".$id."&error=own");
	}
	elseif(!in_array($who,$members["people"]))	{
		header("Location: collab.php?id=".$id."&error=notin");
	}
	else	{
		unset($members["people"][array_search($who,$members["people"])]);
		$members	= serialize($members);
		mysql_query("UPDATE collabs SET `mitglieder`='$members' WHERE `id`='$id'");
		header("Location: collab.php?id=".$id."&result=leaveok");
	}
?>