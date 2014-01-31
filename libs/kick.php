<?php
	$name	= new user($_GET["kick"]);
	$id		= $_GET["id"];
	$collab = new collab($id);
	
	$collab = new collab($id);
	$collab -> remove_member($name -> name, "member");
	$collab -> remove_member($name -> name, "candidate");
	
	$msg = new message;
	$msg -> sender = new user("System");
	$msg -> to = $name;
	$msg -> date = new time;
	$msg -> regard = $collab -> owner -> name . " kicked you";
	$msg -> msg = "
		Hello " . $new -> name . ",<br />
		" . $collab -> owner -> name . " kicked you from his/her collab <a href='collab.php?id=" . $collab -> id . "'>" . $collab -> name . "</a>.
	";
	$msg -> send();
	
	header("Location: admin.php?id=$id&result=kickok");
?>