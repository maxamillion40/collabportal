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
	//Split $sendto into singles
	$sendto = explode(";",$sendto);
	unset($sendto[count($sendto) - 1]);
	print_array($sendto);
	//Prepare message
	foreach($sendto as $send)	{
		$message = array(
			"sender" => $_SESSION["user"],
			"to" => $send,
			"msg" => $msg,
			"regard" => $regard
		);
		send_pm($message);
	}
	header("Location: messages.php?result=sent");
?>