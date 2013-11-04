function update(input,preview)	{
	var input = $("#" + input);
	var preview = $("#" + preview);
	var text = input.val();
	preview.html(text);
}
$(document).ready(function()	{
	$("header a:not([href^='http://'])").click(function(e)	{
		e.preventDefault();
		var link = this.href.split("/").pop();
		if(link != "")	{
			window.location = "../" + link;
		}
	})
});