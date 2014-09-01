"use strict";

// Read collabmessages from the server in the internalID interval lower -> upper
function getMessagesFromInterval(lower, upper, callback)	{
	// Check arguments
	if(lower === undefined | upper === undefined | callback === undefined)	{
		return false;
	}
	// Read the messages
	$.ajax({
		url: "ajax/getMessagesByInterval.ajax.php",
		dataType: "json",
		type: "POST",
		data: {
			cid: $(document).getUrlParam("id"),
			lower: lower,
			upper: upper
		},
		success: function(data)	{
			console.log("Messages received. Passing to callback");
			callback(data, "");
		},
		error:	function(_, __, error)	{
			console.log(error);
			callback(false, error);
		}
	});
}

// Check if a new message is available on the server
function hasNewMessages(latestOnClient, callbackIfTrue, callbackIfFalse)	{
	console.log("Checking for new messages");
	$.ajax({
		url: "ajax/hasNewMessages.ajax.php",
		dataType: "json",
		type: "POST",
		data: {
			cid: $(document).getUrlParam("id"),
			client: latestOnClient
		},
		success: function(data)	{
			if(data > 0)	{
				console.log("There are new messages");
				callbackIfTrue();
			}
			else	{
				console.log("No new messages");
				callbackIfFalse();
			}
		},
		error: function(jqXHR, _, errorThrown)	{
			console.log(errorThrown);
		}
	});
}

// Render a collabmessages
function renderMessagePrepend(msg)	{
	$("#livechat").prepend('<div class="msg msg-' + msg.internalID + '"><div class="msg-head"><span class="msg-name">' + msg.absender + '</span>, ' + msg.timestamp + '</div><div class="msg-body">' + msg.message + '</div>');
	scratchblocks2.parse("pre.blocks");
}
function renderMessageAppend(msg)	{
	$("#livechat").append('<div class="msg msg-' + msg.internalID + '"><div class="msg-head"><span class="msg-name">' + msg.absender + '</span>, ' + msg.timestamp + '</div><div class="msg-body">' + msg.message + '</div>');
	scratchblocks2.parse("pre.blocks");
}