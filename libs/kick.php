<?php
	$name	= $_GET["kick"];
	$id		= $_GET["id"];
	
	$collab = new collab($id);
	$collab -> remove_member($name, "member");
	$collab -> remove_member($name, "candidate");
	
	header("Location: admin.php?id=$id&result=kickok");
?>