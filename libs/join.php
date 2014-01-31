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
			
			$msg = new message;
			$msg -> sender = new user("System");
			$msg -> to = $collab -> owner;
			$msg -> date = new time;
			$msg -> regard = $_USER -> name . " wants to join your collab";
			$msg -> msg = "
				Hello " . $collab -> owner -> name . ",<br />
				" . $_USER -> name . " wants to join your collab <a href='collab.php?id=" . $collab -> id . "'>" . $collab -> name . "</a>.<br />
				To accept or refuse his/her application, visit your collab's <em>administration area</em> and go to <em>Candidates</em>.
			";
			$msg -> send();
			
			header("Location: collab.php?id=" . $id . "&result=applicationok");
		}
		else	{
			$collab -> add_member($who, "member");
			//Benachrichtigung
			header("Location: collab.php?id=".$_GET["id"]."&result=joinok");
		}
	}
?>