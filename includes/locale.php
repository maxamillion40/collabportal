<?php
	$_LOCALE = array();
	$files = scandir($_HOME . "/locale");
	unset($files[0]);
	unset($files[1]);
	
	foreach($files as $l)	{
		$filedata = parse_ini_file($_HOME . "/locale/" . $l, true);
		$_LOCALE[$filedata["meta"]["langcode"]] = $filedata["translations"];
	}
	
	function __($msg, $lang = null)	{
		global $_USER;
		global $_LOCALE;
		if(!is_string($lang))	{
			$lang = $_USER -> language;
		}
		if(isset($_LOCALE[$lang][$msg]))	{
			return $_LOCALE[$lang][$msg];
		}
		else	{
			return $msg;
		}
	}
?>