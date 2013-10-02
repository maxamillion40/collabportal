<?php
	$sendto = mysql_real_escape_string($_POST["sendto"]);
	$regard = mysql_real_escape_string($_POST["regard"]);
	$msg	= mysql_real_escape_string($_POST["msg"]);
	if($regard == "")	{
		$regard = "[Kein Betreff]";
	}
	if($regard == "" or $sendto == "" or $msg == "")	{
		die(header("Location: messages.php?error=emptyfields"));
	}
	//Prepare message
	$message = array(
		"sender" => $_SESSION["user"],
		"to" => $sendto,
		"msg" => $msg,
		"regard" => $regard
	);
	send_pm($message);
	header("Location: messages.php?result=sent");
?>