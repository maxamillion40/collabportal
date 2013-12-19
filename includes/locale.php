<?php
	$_LOCALE = array();
	$files = scandir("locale");
	unset($files[0]);
	unset($files[1]);
	
	foreach($files as $l)	{
		$filedata = parse_ini_file("locale/" . $l, true);
		$_LOCALE[$filedata["meta"]["langcode"]] = $filedata["translations"];
	}
?>