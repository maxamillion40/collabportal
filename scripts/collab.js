$(document).ready(function()	{
	// Toggle "Back to Top" button
	$(window).scroll(function()	{
		if($(this).scrollTop() > 350) {
			$("#backToTop").show();
		}
		else	{
			$("#backToTop").hide();
		}
	});
	
	// Scroll up
	$("#backToTop").click(function(){
		$("html, body").animate({scrollTop : 0}, 1000);
	});
	
	// Edit announcements
	$("#box-announcements").on("click" , "p.canEdit", function()	{
		$(this).replaceWith("<textarea name=\"cnews\" id=\"cnews\">" + $(this).html().replace(/<br \/>/g, "\r\n") + "</textarea>");
		$("#box-announcements .inner").css("padding", "5px");
		$("#box-announcements div.box-content div.inner textarea").focus();
	});
	
	// Save on blur
	$("#box-announcements").on("blur", "#cnews", function()	{
		// Fetch collab ID and new value
		var cid = $(document).getUrlParam("id");
		var v = $("#cnews").val()
		
		// Show loader
		$("#box-announcements .boxLoader").css("display", "inline-block");
		
		// Make sure it's not empty
		if(v == "")	{
			v = "Nothing here";
		}
		
		// Save
		$.ajax({
			url: "libs/setcollabnews.ajax.php?cid=" + cid,
			data: {news: v},
			dataType: "text",
			type: "POST",
			async: false,
			success: function(data)	{
				// Reset box
				$("#cnews").replaceWith("<p class=\"canEdit\">" + data + "</p>");
				$("#box-announcements .inner").css("padding", "5px 20px");
			},
			error: function(jqXHR, textStatus, errorThrown)	{
				alert("Error: " + errorThrown);
			}
		});
		
		// Hide loader
		$("#box-announcements .boxLoader").css("display", "none");
	});
});