"use strict";

$(document).ready(function()	{
	// Get the first 10 messages and output them
	getMessagesFromInterval(1, 10, function(data)	{
		var i;
		for(i = 0; i < data.count; i++)	{
			var msg = data.list[i];
			// Prepend to #livechat
			$("#livechat").prepend('<div class="msg msg-' + msg.internalID + '"><div class="msg-head"><span class="msg-name">' + msg.absender + '</span>, ' + msg.timestamp + '</div><div class="msg-body">' + msg.message + '</div>');
		}
	});
});