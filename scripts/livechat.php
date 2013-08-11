<?php
	session_start();
	header("Content-type: application/javascript");
	include("../includes/func.php");
	mysql_auto_connect();
	$members	= unserialize(mysql_get("SELECT `mitglieder` FROM `collabs` WHERE id='".mysql_real_escape_string($_GET["id"])."'")[0]["mitglieder"]);
	if(!in_array($_SESSION["user"],$members["people"]) and $members["founder"] != $_SESSION["user"])	{
		echo "var member = false; \n";
	}
	else	{
		echo "var member = true; \n";
	}
?>
function chat()	{
$.ajax({
	url: "libs/livechat_ajax.php?id="+$(document).getUrlParam("id"),
	data: "",
	type: "POST",
	success: function(data) {
		$("#livechat").html(data);
	}
	});
}

if(member == true)	{
	window.onload = chat();
	window.setInterval("chat()",10000);
}
else	{
	$(document).ready(function()	{
		$("#msgbox").remove();
		$("#loading").html("Nachrichten sind nur für Mitglieder einsehbar!");
	});
}