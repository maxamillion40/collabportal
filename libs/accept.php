<?php
	
	$new = new user($_GET["who"]);
	$collab = new collab($_GET["id"]);
	if($collab -> member_rank($new -> name) == "candidate")	{
		$collab -> add_member($new -> name, "member");
		$collab -> remove_member($new -> name, "candidate");
		
		$msg = new message;
		$msg -> sender = new user("System");
		$msg -> to = new user($new -> name);
		$msg -> date = new time;
		$msg -> regard = $collab -> owner -> name . " accepted your application";
		$msg -> msg = "
			Hello " . $new -> name . ",<br />
			" . $collab -> owner -> name . " accepted your application for his/her collab <a href='collab.php?id=" . $collab -> id . "'>" . $collab -> name . "</a>.
		";
		$msg -> send();
		
		die(header("Location: admin.php?id=" . $collab -> id . "d&result=acceptok"));
	}
?>