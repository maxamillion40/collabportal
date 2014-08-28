"use strict";

// Read collabmessages from the server in the internalID interval lower -> upper
function getMessagesFromInterval(lower, upper, callback)	{
	// Check arguments
	if(lower === undefined | upper === undefined | callback === undefined)	{
		return false;
	}
	// Read the messages
	return $.ajax({
		url: "ajax/getMessagesByInterval.ajax.php",
		dataType: "json",
		type: "POST",
		data: {
			cid: $(document).getUrlParam("id"),
			lower: lower,
			upper: upper
		},
		success: function(data)	{
			callback(data);
		},
		error:	function()	{
			callback(false);
		}
	});
}