<?php
	if(!isset($_GET["id"]) or $_GET["id"] == "")	{
		die("No project ID given");
	}
	$html = @file_get_contents("http://scratch.mit.edu/projects/" . $_GET["id"]);
	if(preg_match("#<h2 id=\"title\">(.*)</h2>#Uis",$html))	{
		preg_match("#<h2 id=\"title\">(.*)</h2>#Uis",$html,$matches);
		echo $matches[1];
	}
	else	{
		echo "Scratch Projekt";
	}
?>