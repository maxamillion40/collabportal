function showsbpopup(id)	{
	$("#dialogbox").dialog({
		width: 550,
		height: 500,
		autoopen: true,
		title: "Scratch Projekt",
		closetext: "Scratch Projekt schließen",
		resizable: false,
		draggable: false,
		modal: true,
		hide: "clip",
		show: "clip",
		open: function(event,ui)	{
			$(".ui-dialog-titlebar-close").removeAttr("title");
			$(".ui-dialog-content").html("<iframe allowtransparency='true' width='485' height='402' src='http://scratch.mit.edu/projects/embed/"+id+"/' allowfullscreen></iframe>");
			$.ajax({
				url: "libs/getProjectName.ajax.php?id=" + id,
				data: "",
				type: "GET",
				success: function(data) {
					$(".ui-dialog-title").html(data);
				}
			});
		},
		close: function(event,ui)	{
			$(this).html("");
			$(this).dialog("destroy");
		},
		focus: function(event,ui)	{
			$(".ui-dialog-content").focus();
		}
	});
}