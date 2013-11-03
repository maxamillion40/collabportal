function update(input,preview)	{
	var input = $("#" + input);
	var preview = $("#" + preview);
	var text = input.val();
	preview.html(text);
}
$(document).ready(function()	{
	$("header a").click(function(e)	{
		e.preventDefault();
		alert("Bitte benutze den Button \"Zurück zum Collabportal\" in der Übersicht, um zum CollabPortal zurückzukehren..");
	})
});