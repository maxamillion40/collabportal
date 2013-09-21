$(document).ready(function()	{
	$("tr[id^=msg-]").click(function()	{
		navigate("read.php?id=" + this.id);
	});
});