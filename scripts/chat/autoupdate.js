function countMessages()	{
	var elem = $("#livechat div.msg").attr("class");
	if(elem)	{
		elem = elem.split(" ")[1];
		elem = Number(elem.match(/\d/g).join(""));
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
	return r;
}

function hasNewMessages()	{
	if(getMessagesOnServer() > countMessages())	{
		return true;
	}
	else	{
		return false;
	}
}

function loadNewMessages(startAt)	{
	$.ajax({
		url: "libs/loadCollabMessages.ajax.php?lastID=" + startAt + "&cid=" + $(document).getUrlParam("id") + "&method=initial",
		dataType: "text",
		type: "GET",
		success: function(data)	{
			if(data.length > 5)	{
				$("#livechat").prepend(data);
			}
		},
		error: function(jqXHR, textStatus, errorThrown)	{
			loading = false;
		}
	});
}

window.setInterval(function()	{
	if(hasNewMessages())	{
		loadNewMessages(countMessages());
	}
}, 2000);