var loading = true;

function countMessages()	{
	var elem = $("#livechat div.msg").attr("class");
	if(elem)	{
		elem = elem.split(" ")[1];
		elem = Number(elem.match(/\d/g).join(""));
		console.log("Latest message: " + elem)
		return elem;
	}
	else	{
		return 0;
	}
}

function getMessagesOnServer()	{
	var r = 0;
	$.ajax({
		url: "libs/hasNewMessages.ajax.php?total=" + countMessages() + "&cid=" + $(document).getUrlParam("id"),
		dataType: "text",
		type: "GET",
		async: false,
		success: function(data)	{
			r = Number(data.match(/\d/g).join(""));
		},
		error: function(jqXHR, textStatus, errorThrown)	{
			loading = false;
		}
	});
	console.log("Latest message on server: " + r)
	return r;
}

function hasNewMessages()	{
	if(Number(getMessagesOnServer()) > Number(countMessages()))	{
		return true;
	}
	else	{
		return false;
	}
}

function loadNewMessages(startAt)	{
	console.log("Starting download of new messages");
	console.log("Calling " + "libs/loadCollabMessages.ajax.php?lastID=" + startAt.toString() + "&cid=" + $(document).getUrlParam("id") + "&method=initial");
	$.ajax({
		url: "libs/loadCollabMessages.ajax.php?lastID=" + startAt.toString() + "&cid=" + $(document).getUrlParam("id") + "&method=initial",
		dataType: "text",
		type: "GET",
		success: function(data)	{
			if(data.length > 5)	{
				console.log("Received new messages");
				$("#livechat").prepend(data);
			}
		},
		error: function(jqXHR, textStatus, errorThrown)	{
			console.log("Error");
			loading = false;
		}
	});
}

window.setInterval(function()	{
	console.log("Checking for new messages");
	if(hasNewMessages())	{
		console.log("New messages found");
		loadNewMessages(countMessages());
	}
}, 2000);