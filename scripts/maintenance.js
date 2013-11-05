function update(input,preview)	{
	var input = $("#" + input);
	var preview = $("#" + preview);
	var text = input.val();
	preview.html(text);
}
$(document).ready(function()	{
	$("img").error(function()	{
		var src = $(this).attr("src");
		$(this).attr("src", "../" + src);
	});
	$("header a:not([href^='http://'])").click(function(e)	{
		e.preventDefault();
		var link = this.href.split("/").pop();
		if(link != "")	{
			window.location = "../" + link;
		}
	})
	$("#trans").click(function()	{
		var href = this.href.split("/");
		href.length = href.length - 2;
		href = href.join("/");
		window.location = href;
	});
	$("#userlist").tablesorter();
});

function search(what)	{
	$("#userlist tbody td, #userlist td").each(function()	{
		if($(this).html() == what)	{
			$(this).parent().css("font-weight","bold");
		}
	});
}

function reset()	{
	$("#userlist td").each(function()	{
		$(this).css("font-weight","normal");
		$("#search").val("");
	});
}