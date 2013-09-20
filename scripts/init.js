$(document).ready(function() {
	//Login bubble
	$("#join a").click(function()	{
		$("#login").toggle("fade");
	});
});

//A function to redirect the user
function navigate(to,dialog=null)	{
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

//Unread messages animation
/* window.setInterval(function()	{
	$("#notificationsCount").slideUp();
	$("#notificationsCount").slideDown();
},5000) */