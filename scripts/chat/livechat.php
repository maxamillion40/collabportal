<?php
	session_start();
	header("Content-type: application/javascript");
	include("../includes/func.php");
	mysql_auto_connect();
	$members	= mysql_get("SELECT `mitglieder`,`status` FROM `collabs` WHERE id='".mysql_real_escape_string($_GET["id"])."'");
	echo "var status = '".$members[0]["status"]."'; \n";
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
var reload = true;
var window_focus = true;
var title = $("title").html();
var cid = $(document).getUrlParam("id");
var msgInterval;
var msgInterval2;
var msg = new Array;
	msg["msgCount"] = Number.POSITIVE_INFINITY;
//
function getAllMessages(id)	{
	if(member == true)	{
		if(reload == true)	{
			$.ajax({
				url: "libs/livechat_ajax.php?id=" + id,
				dataType: "json",
				type: "GET",
				success: function(data)	{
					// Reset
					window.clearInterval(msgInterval);
					// Message count
					var oldcount = msg["msgCount"];
					var newcount = data["msgCount"];
					// Inform user about new messages
					msg = data;
					if((newcount > oldcount && $("#livechat").visible(true) == false) || (window_focus == false && newcount > oldcount))	{
						reload = false;
						msgInterval = window.setInterval(function()	{
							$("title").html("Neue Nachricht!");
						},2000);
						msgInterval2 = window.setInterval(function()	{
							$("title").html(title);
						},3000);
					}
					// Insert messages
					$("#livechat").html("");
					var max = msg["msgCount"];
					for(i=0;i<max;i++)	{
						var output;
						var m = msg["msgList"][i];
						var output = "<div class='msg msg-" + m["id"] + "'><div class='msg-head'>" + m["absender"] + " am " + m["timestamp"] + "</div><div class='msg-body'>" + m["message"] + "</div></div>";
						$("#livechat").append(output);
					}
					scratchblocks2.parse("pre.blocks");
				},
				error: function(jqXHR, textStatus, errorThrown)	{
					$("#livechat").html("Fehler beim Laden der Nachrichten: " + errorThrown);
				}
			});
		}
	}
	else	{
		$("#livechat").html("Nachrichten sind nur für Mitglieder sichtbar.");
		$("#msgbox").remove();
	}
	if(status != "open")	{
		$("#msgbox").html("Dieses Collab ist beendet.");
	}
}

$(document).ready(function()	{
	getAllMessages(cid);
});

window.setInterval(function()	{
	if($("#livechat").visible(true) && window_focus == true)	{
		window.clearInterval(msgInterval);
		window.clearInterval(msgInterval2);
		reload = true;
		$("title").html(title);
	}
},500);
window.setInterval(function()	{
	getAllMessages(cid);
},3000);

$(document).on("show.visibility",function()	{
	window_focus = true;
});
$(document).on("hide.visibility",function()	{
	window_focus = false;
});