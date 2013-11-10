<?php
	$id = mysql_real_escape_string($_GET["id"]);
	$new = mysql_real_escape_string($_GET["who"]);
	$members = mysql_get("SELECT `mitglieder` FROM `collabs` WHERE `id`=$id");
	$name = mysql_get("SELECT `name` FROM `collabs` WHERE `id='$id'`");
	if(in_array($new,$members[0]["mitglieder"]["candidates"]))	{
		$members[0]["mitglieder"]["people"][] = $new;
		unset($members[0]["mitglieder"]["candidates"][array_search($kick,$members[0]["mitglieder"]["candidates"])]);
		$members = serialize($members[0]["mitglieder"]);
		mysql_query("UPDATE `collabs` SET `mitglieder`='$members' WHERE `id`='$id'");
		$pm = array(
			"to" => $new,
			"sender" => "Systemnachricht",
			"regard" => "Du wurdest im Collab ".$name[0]["name"]." aufgenommen",
			"msg" => "Dein Mitgliedsantrag wurde akzeptiert. Du hast nun alle Rechte eines Mitglieds!"
		);
		send_pm($pm);
		header("Location: admin.php?id=$id&result=acceptok");
	}
?>