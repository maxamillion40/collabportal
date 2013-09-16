<?php
	print_array($_POST);
	$id = mysql_real_escape_string($_GET["id"]);
	//
	$members_max = false;
	$confirm_join = false;
	//
	if(isset($_POST["check-max-members"]) and $_POST["check-max-members"] == "on")	{
		$members_max = intval($_POST["input-max-members"]);
		if($members_max <= 0)	{
			die(header("Location: admin.php?id=$id&error=noint"));
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
	mysql_query("UPDATE `collabs` SET `settings` = '$settings' WHERE `id` = '$id'") or die(mysql_error());
	header("Location: admin.php?id=$id&result=settingsok");
?>