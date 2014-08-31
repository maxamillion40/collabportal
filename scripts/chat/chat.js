"use strict";
var title;
var autoreload = true;

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
			getMessagesFromInterval(data.internalID - 9, data.internalID, function(res, error)	{
				if(res != false)	{
					var i;
					for(i = 0; i < res.count; i++)	{
						var msg = res.list[i];
						// Prepend to #livechat
						renderMessage(msg);
					}
				}
				else	{
					autoreload = false;
				}
			});
		},
	});
	
	// Update every n/1000 seconds
	window.setInterval(function()	{
		if(autoreload == true)	{
			// Get newest messageID visible for the user
			var latestHere = ($("div.msg").first().attr("class")).split(" ")[1];
			latestHere = Number(latestHere.match(/\d/g).join(""));
			// Check for new messages
			hasNewMessages(latestHere, function()	{
				// Load up to 10 new messages. The rest comes during the next update
				getMessagesFromInterval(latestHere + 1, latestHere + 10, function(res, error)	{
					if(res != false)	{
						// Notification
						var audio = new Audio("sounds/pop.ogg");
						audio.play();
						title = $("title").html();
						$("title").html("Activity!");
						// Loop the new messages
						var i;
						for(i = 0; i < res.count; i++)	{
							var msg = res.list[i];
							// Prepend to #livechat
							renderMessage(msg);
						}
					}
					else	{
						autoreload = false;
					}
				});
			},
			function()	{
				//
			});
		}
	}, 2000);
	
	// Reset title
	$("body").mouseover(function()	{
		if($("title").html() == "Activity!")	{
			$("title").html(title);
		}
	});
});