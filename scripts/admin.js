$(document).ready(function() {
	$("#check-max-members").click(function()	{
		var state = $(this).is(":checked");
		if(state == false)	{
			$("#row-max-members").addClass("static-bg");
			$("#row-max-members").children().each(function()	{
				$(this).css("color","#CFCFCF");
				$("#input-max-members").attr("disabled","disabled").attr("value","");
			});
		}
		else	{
			$("#row-max-members").removeClass("static-bg");
			$("#row-max-members").children().each(function()	{
				$(this).css("color","#322F31");
				$("#input-max-members").removeAttr("disabled");
			});
		}
	});
	//
	$("#check-confirm-join").click(function()	{
		var state = $(this).is(":checked");
		if(state == false)	{
			$("#row-confirm-join").addClass("static-bg");
			$("#row-confirm-join").children().each(function()	{
				$(this).css("color","#CFCFCF");
			});
		}
		else	{
			$("#row-confirm-join").removeClass("static-bg");
			$("#row-confirm-join").children().each(function()	{
				$(this).css("color","#322F31");
			});
		}
	});
});