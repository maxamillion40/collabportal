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
});