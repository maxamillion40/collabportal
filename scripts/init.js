$(document).ready(function() {
	//generate tooltips
	$(document).tooltip();
	//Generate accordion menu
	$("#accordion").accordion({heightStyle: "content"});
	//Remove tooltips for textarea
	$("textarea").tooltip({ disabled: true });
	//fade out info boxes
	setTimeout(function(){
		$(".ui-state-error, .ui-state-highlight, .remove").fadeOut(2000);
	},5000);
	//Login bubble
	$("#join a").click(function()	{
		$("#login").toggle("fade");
	});
	//Hide info boxes on click
	$(".ui-state-error, .ui-state-highlight").click(function()	{
		$(this).fadeOut(2000);
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