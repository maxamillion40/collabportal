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
	foreach($sendto as $send)	{
		$message = new message;
		$message -> regard = $regard;
		$message -> to = new user($send);
		$message -> sender = $_USER;
		$message -> msg = $msg;
		$message -> date = new time();
		
		$message -> send();
		echo "<pre>";
		print_r($message);
	}
	header("Location: messages.php?result=sent");
?>