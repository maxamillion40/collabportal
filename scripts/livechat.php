<?php
	session_start();
	header("Content-type: application/javascript");
	include("../includes/func.php");
	mysql_auto_connect();
	$members	= mysql_get("SELECT `mitglieder` FROM `collabs` WHERE id='".mysql_real_escape_string($_GET["id"])."'");
	if(is_loggedin())	{
		if(!in_array($_SESSION["user"],$members[0]["mitglieder"]["people"]) and $members[0]["mitglieder"]["founder"] != $_SESSION["user"])	{
			echo "var member = false; \n";
		}
		else	{
			echo "var member = true; \n";
		}
	}
	else	{
		echo "var member = false \n";
	}
?>
var title = $("title").html();
var cid = $(document).getUrlParam("id");
var msgInterval;
var msg = new Array;
	msg["msgCount"] = Number.POSITIVE_INFINITY;
	msg["msgCount"] = 1;
//
function getAllMessages(id)	{
	$.ajax({
		url: "libs/livechat_ajax.php?id=" + id,
		dataType: "json",
		type: "GET",
		success: function(data)	{
			var oldcount = msg["msgCount"];
			var newcount = data["msgCount"];
			msg = data;
			if(newcount > oldcount)	{
				window.setInterval(function()	{
					$("title").html(newcount - oldcount + " neue Nachrichten");
				},1000);
				window.setInterval(function()	{
					$("title").html(title);
				},2000);
				
			}
		},
		error: function(jqXHR, textStatus, errorThrown)	{
			return false;
		}
	});
}
getAllMessages(cid);