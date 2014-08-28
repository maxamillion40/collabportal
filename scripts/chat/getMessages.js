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
			callback(data);
		},
		error:	function()	{
			callback(false);
		}
	});
}

// Check if a new message is available on the server
function hasNewMessages(latestOnClient, callbackIfTrue, callbackIfFalse)	{
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
				callbackIfFalse();
			}
		},
	});
}