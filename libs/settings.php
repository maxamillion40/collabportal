﻿<?php
	$id = $_GET["id"];
	$collab = new collab($id);
	//
	$members_max = false;
	$confirm_join = false;
	//
	if(isset($_POST["check-max-members"]) and $_POST["check-max-members"] == "on")	{
		$members_max = intval($_POST["input-max-members"]);
		if($members_max <= 0)	{
			die(header("Location: admin.php?id=$id&error=noint"));
		}
		if($members_max < count($collab -> members["people"]) + 1)	{
			die(header("Location: admin.php?id=$id&error=toosmall"));
		}
	}
	if(isset($_POST["check-confirm-join"]) and $_POST["check-confirm-join"] == "on")	{
		$confirm_join = true;
	}
	//
	$settings = array();
	$settings["members_max"] = $members_max;
	$settings["confirm_join"] = $confirm_join;
	$settings = serialize($settings);
	$_MYSQL -> set("UPDATE `collabs` SET `settings` = ? WHERE `id` = ?", array($settings, $id));
	header("Location: admin.php?id=$id&result=settingsok");
?>