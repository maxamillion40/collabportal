<?php
	
	$new = new user($_GET["who"]);
	$collab = new collab($_GET["id"]);
	if($collab -> member_rank($new -> name) == "candidate")	{
		$collab -> add_member($new -> name, "member");
		die(header("Location: admin.php?id=" . $collab -> id . "d&result=acceptok"););
	}
?>