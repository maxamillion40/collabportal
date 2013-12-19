<?php
	$_LOCALE = array();
	$files = scandir("locale");
	unset($files[0]);
	unset($files[1]);
	
	foreach($files as $l)	{
		$filedata = parse_ini_file("locale/" . $l, true);
		$_LOCALE[$filedata["meta"]["langcode"]] = $filedata["translations"];
	}
	
	function __($msg, $lang = null)	{
		global $_LOCALE;
		if(!is_string($lang))	{
			$lang = "en_US";
		}
		if(isset($_LOCALE[$lang][$msg]))	{
			return $_LOCALE[$lang][$msg];
		}
		else	{
			return $msg;
		}
	}
?>