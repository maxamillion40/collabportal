<?php
	$sendto = $_POST["sendto"];
	$regard = $_POST["regard"];
	$msg	= $_POST["msg"];
	if($regard == "")	{
		$regard = "[Kein Betreff]";
	}
	if($regard == "" or $sendto == "" or $msg == "")	{
		die(header("Location: messages.php?error=emptyfields"));
	}
	//Split $sendto into singles
	$sendto = explode(";",$sendto);
	unset($sendto[count($sendto) - 1]);
	//Prepare message
	$sentTo = array();
	foreach($sendto as $send)	{
		if(!in_array($send, $sentTo))	{
			$message = new message;
			$message -> regard = $regard;
			$message -> to = new user($send);
			$message -> sender = $_USER;
			$message -> msg = $msg;
			$message -> date = new time();
			
			$message -> send();
			$sentTo[] = $message -> to -> name;
		}
	}
	header("Location: outbox.php?result=sent");
?>