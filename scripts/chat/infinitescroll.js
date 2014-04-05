﻿var lastID = 0;
var loading = true;
var reachedEnd = false;

// Get latest message ID
$.ajax({
	url: "libs/getLatestMessageID.ajax.php?cid=" + $(document).getUrlParam("id"),
	dataType: "text",
	type: "GET",
	success: function(data)	{
		lastID = Number(data.match(/\d/g).join(""));
	},
});

$(document).ready(function()	{
	//Load first 25 posts
	loadposts(lastID, "initial");
	//Load more on click
	$("button#loadMore").click(function()	{
		loadposts(lastID, "repeated");
	});

});

$(window).scroll(function()	{
	if($(window).scrollTop() + $(window).height() > $(document).height() - 100)	{
		if(loading == false && reachedEnd == false)	{
			loadposts(lastID, "repeated");
		}
	}
});

function loadposts(startID, method)	{
	loading = true;
	$.ajax({
		url: "libs/loadCollabMessages.ajax.php?lastID=" + startID + "&cid=" + $(document).getUrlParam("id") + "&method=" + method,
		dataType: "text",
		type: "GET",
		success: function(data)	{
			if(data.length > 5)	{
				$("#livechat").append(data);
				lastID = lastID - 25;
				loading = false;
				scratchblocks2.parse("#livechat pre:not(.parsed)");
				$("#livechat pre").addClass("parsed");
			}
			else	{
				$("#loading").html("<p>Discussion started here.</p>");
				reachedEnd = true;
			}
		},
		error: function(jqXHR, textStatus, errorThrown)	{
			if(errorThrown == "Forbidden")	{
				$(".chatbox-form").html("");
				$("#loading").html("<p>Only members can see the chat.</p>");
				loading = false;
				reachedEnd = true;
			}
		}
	});
}