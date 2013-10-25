$(document).ready(function()	{
	$("tr[id^=msg-]").click(function()	{
		navigate("read.php?id=" + this.id);
	});
});

function divide_sendto()	{
	var content = $("input[name=sendto]").val();
	if(content != "")	{
		content = content.replace(/ /g,";");
		if(content.charAt(content.length - 1) != ";")	{
			content = content + ";";
		}
		content = content.toLowerCase();
		$("input[name=sendto]").val(content);
	}
}