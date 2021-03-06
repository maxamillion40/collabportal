﻿$(document).ready(function()	{
	if(typeof(scratchblocks2) !== "undefined")	{
		scratchblocks2.parse("pre.blocks");
	}
	$("form").submit(function()	{
		$(this).find("input[type=submit], button[type=submit]").attr("disabled", "disabled");
	});
});

//A function to redirect the user
function navigate(to,dialog)	{
	if(typeof(dialog) == "string")	{
		if(confirm(dialog))	{
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
		plugins: "link lists emoticons image sb scratchblocks2",
		selector: "textarea",
		language: "de",
		toolbar: "undo redo | bold italic underline | link unlink | image sb scratchblocks | numlist bullist | emoticons",
		menubar: false,
		statusbar: false,
		width: "100%",
		height: 200,
	});
}

// Login box
function loginbox()	{
var LI = document.getElementById("login");
	if(LI.style.display == "none") {
		LI.style.display = "block";
	}
	else {
		LI.style.display = "none";
	}
}