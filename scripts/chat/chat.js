"use strict";

$(document).ready(function()	{
	// Get the internalID of the latest message
	$.ajax({
		url: "ajax/getLatestMessageID.ajax.php",
		dataType: "json",
		type: "POST",
		data: {
			cid: $(document).getUrlParam("id")
		},
		success: function(data)	{
			// Get the first 10 messages and output them
			getMessagesFromInterval(data.internalID - 9, data.internalID, function(data)	{
				var i;
				for(i = 0; i < data.count; i++)	{
					var msg = data.list[i];
					// Prepend to #livechat
					$("#livechat").prepend('<div class="msg msg-' + msg.internalID + '"><div class="msg-head"><span class="msg-name">' + msg.absender + '</span>, ' + msg.timestamp + '</div><div class="msg-body">' + msg.message + '</div>');
				}
			});
		},
	});
});