$(document).ready(function()	{
	$("tr[id^=msg-]").click(function()	{
		navigate("read.php?id=" + this.id);
	});
	$("input[type=checkbox]").click(function(e)	{
		e.stopPropagation();
	});
	$("#select-all").click(function()	{
		var state = $("input[type=checkbox]").prop("checked");
		if(state == true)	{
			$("input[type=checkbox]").prop("checked",true);
		}
		else	{
			$("input[type=checkbox]").prop("checked",false);
		}
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