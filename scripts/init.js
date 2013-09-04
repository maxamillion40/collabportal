﻿$(document).ready(function() {
	//Remove tooltips for textarea
	$("textarea").tooltip({ disabled: true });
	//Login bubble
	$("#join a").click(function()	{
		$("#login").toggle("fade");
	});
});

//A function to redirect the user
function navigate(to,dialog=true)	{
	if(dialog == true)	{
		if(confirm("Bist du sicher?"))	{
			window.location = to;
		}
	}
	else	{
		window.location = to;
	}
}

//Launch Tinymce
if(typeof(tinymce) !== "undefined")	{
	tinymce.init({
		plugins: "link lists emoticons image sb",
		selector: "textarea",
		language: "de",
		toolbar: "undo redo | bold italic underline | link unlink | image sb | numlist bullist | emoticons",
		menubar: false,
		statusbar: false,
		width: "100%",
		height: 300,
	});
}