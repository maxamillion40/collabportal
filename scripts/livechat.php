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
var window_focus = true;
var title = $("title").html();
var cid = $(document).getUrlParam("id");
var msgInterval;
var msg = new Array;
	msg["msgCount"] = Number.POSITIVE_INFINITY;
//
function getAllMessages(id)	{
	if(member == true)	{
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
				if((newcount > oldcount && $("#livechat").visible(true) == false) || window_focus == false)	{
					msgInterval = window.setInterval(function()	{
						$("title").html(newcount - oldcount + " neue Nachrichten");
						window.setTimeout(function()	{
							$("title").html(title);
						},1000);
					},2000);
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
				//
			}
		});
	}
	else	{
		$("#livechat").html("Nachrichten sind nur für Mitglieder sichtbar.");
	}
}

$(document).ready(function()	{
	getAllMessages(cid);
});

window.setInterval(function()	{
	if($("#livechat").visible(true))	{
		window.clearInterval(msgInterval);
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