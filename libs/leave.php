<?php
	$who		= $_USER -> name;
	$id			= $_GET["id"];
	$collab		= new collab($id);
	if($collab -> members["founder"] == $who)	{
		header("Location: collab.php?id=".$id."&error=own");
	}
	elseif($collab -> member_rank($who) == "guest")	{
		header("Location: collab.php?id=".$id."&error=notin");
	}
	else	{
		unset($collab -> members["people"][$who]);
		
		$arr = array(
			"founder" => $collab -> members["founder"],
			"people" => array(),
			"candidates" => array(),
		);
		
		foreach($collab -> members["people"] as $member)	{
			$arr["people"][] = $member -> name;
		}
		foreach($collab -> members["candidates"] as $member)	{
			$arr["candidates"][] = $member -> name;
		}
		
		$_MYSQL -> set("UPDATE collabs SET `mitglieder`=? WHERE `id`=?",array(
			serialize($arr),
			$id
		));
		if(isset($_GET["red"])) {
			header("Location: mystuff.php?result=leaveok");
		}
		else {
			header("Location: collab.php?id=".$id."&result=leaveok");
		}
	}
?>