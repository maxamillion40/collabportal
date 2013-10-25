<?php
	$id = mysql_real_escape_string($_GET["id"]);
	$new = mysql_real_escape_string($_GET["who"]);
	$members = mysql_get("SELECT `mitglieder` FROM `collabs` WHERE `id`=$id")[0]["mitglieder"];
	if(in_array($new,$members["candidates"]))	{
		$members["people"][] = $new;
		unset($members["candidates"][array_search($kick,$members["candidates"])]);
		$members = serialize($members);
		mysql_query("UPDATE `collabs` SET `mitglieder`='$members' WHERE `id`='$id'");
		$pm = array(
			"to" => $new,
			"sender" => "Systemnachricht",
			"regard" => "Du wurdest im Collab X aufgenommen",
			"msg" => "Dein Mitgliedsantrag wurde akzeptiert. Du hast nun alle Rechte eines Mitglieds!"
		);
		send_pm($pm);
		header("Location: admin.php?id=$id&result=acceptok");
	}
?>