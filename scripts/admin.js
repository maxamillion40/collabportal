$(document).ready(function()	{
	//
	// Handler on page load
	//
	
	if($("#check-max-members").is(":checked"))	{
		$("#row-max-members").css("color","#322F31");
		$("#input-max-members").removeAttr("disabled");
		$("#row-max-members").removeClass("static-bg");
	}
	else	{
		$("#row-max-members").css("color","#9F9F9F");
		$("#input-max-members").attr("disabled","disabled");
		$("#input-max-members").attr("value","");
		$("#row-max-members").addClass("static-bg");
	}
	//
	if($("#check-confirm-join").is(":checked"))	{
		$("#row-confirm-join").css("color","#322F31");
		$("#row-confirm-join").removeClass("static-bg");
	}
	else	{
		$("#row-confirm-join").css("color","#9F9F9F");
		$("#row-confirm-join").addClass("static-bg");
	}
	//
	if($("#check-new-members").is(":checked"))	{
		$("#row-new-members").css("color","#322F31");
		$("#row-new-members").removeClass("static-bg");
	}
	else	{
		$("#row-new-members").css("color","#9F9F9F");
		$("#row-new-members").addClass("static-bg");
	}
	
	//
	// Handler for click on a setting
	//
	
	$("#check-max-members").click(function()	{
		if($("#check-max-members").is(":checked"))	{
			$("#row-max-members").css("color","#322F31");
			$("#input-max-members").removeAttr("disabled");
			$("#row-max-members").removeClass("static-bg");
			$("#input-max-members").attr("value","2");
		}
		else	{
			$("#row-max-members").css("color","#9F9F9F");
			$("#input-max-members").attr("disabled","disabled");
			$("#input-max-members").attr("value","");
			$("#row-max-members").addClass("static-bg");
		}
	});
	//
	$("#check-confirm-join").click(function()	{
		if($("#check-confirm-join").is(":checked"))	{
			$("#row-confirm-join").css("color","#322F31");
			$("#row-confirm-join").removeClass("static-bg");
		}
		else	{
			$("#row-confirm-join").css("color","#9F9F9F");
			$("#row-confirm-join").addClass("static-bg");
		}
	});
	//
	$("#check-new-members").click(function()	{
		if($("#check-new-members").is(":checked"))	{
			$("#row-new-members").css("color","#322F31");
			$("#row-new-members").removeClass("static-bg");
		}
		else	{
			$("#row-new-members").css("color","#9F9F9F");
			$("#row-new-members").addClass("static-bg");
		}
	});
	
	
	// Collab beenden
	$("#success").click(function()	{
		var state = $("#success").prop("checked");
		if(state == true)	{
			$("#enter-url").show();
		}
		else	{
			$("#enter-url").hide();
		}
	});
});