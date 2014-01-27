var lastID = 0;
var loading = true;

// Get latest message ID
$.ajax({
	url: "libs/getLatestMessageID.ajax.php",
	dataType: "text",
	type: "GET",
	success: function(data)	{
		lastID = data;
	},
});

$(document).ready(function()	{
	//Load first 10 posts
	loadposts(lastID);
});

$(window).scroll(function()	{
	if($(window).scrollTop() + $(window).height() > $(document).height() - 100)	{
		if(loading == false)	{
			loadposts(lastID);
		}
	}
});

function loadposts(startID)	{
	loading = true;
	$.ajax({
		url: "libs/loadCollabMessages.ajax.php?lastID=" + startID + "&cid=" + $(document).getUrlParam("id"),
		dataType: "text",
		type: "GET",
		success: function(data)	{
			if(data != "")	{
				$("#livechat").append(data);
				lastID = lastID - 10;
				loading = false;
			}
		},
		error: function(jqXHR, textStatus, errorThrown)	{
			$("#livechat").html("Fehler beim Laden der Nachrichten: " + errorThrown + "<br /> Bitte lade die Seite neu (F5)");
			loading = false;
		}
	});
}