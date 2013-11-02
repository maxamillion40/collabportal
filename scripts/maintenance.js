function update(input,preview)	{
	var input = $("#" + input);
	var preview = $("#" + preview);
	var text = input.val();
	preview.html(text);
}