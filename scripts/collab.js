$(document).ready(function()	{
	$(window).scroll(function()	{
		if($(this).scrollTop() > 350) {
			$("#backToTop").show();
		}
		else	{
			$("#backToTop").hide();
		}
	});
	
	$("#backToTop").click(function(){
		$("html, body").animate({scrollTop : 0}, 1000);
	});
});