<?php
	$who		= $_USER -> name;
	$id			= $_GET["id"];
	$collab		= new collab($id);
	
	// Is this user already in the collab?
	if($collab -> member_rank($who) != "guest")	{
		header("Location: collab.php?id=" . $id . "&error=alreadyin");
	}
	else	{
		//Muss Beitritt bestätigt werden?
		if($collab -> settings["confirm_join"] == true)	{
			$collab -> add_member($who, "candidate");
			header("Location: collab.php?id=" . $id . "&result=applicationok");
		}
		else	{
			$collab -> add_member($who, "member");
			//Benachrichtigung
			header("Location: collab.php?id=".$_GET["id"]."&result=joinok");
		}
	}
?>