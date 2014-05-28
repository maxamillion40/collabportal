<?php
	$_LOCALE = array();
	$files = scandir($_HOME . "/locale");
	unset($files[0]);
	unset($files[1]);
	
	foreach($files as $l)	{
		//$filedata = parse_ini_file($_HOME . "/locale/" . $l, true);
		//$_LOCALE[$filedata["meta"]["langcode"]] = $filedata["translations"];
		//Load .po file
		$po = file($_HOME . "/locale/" . $l, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		//Create new language tree in $_LOCALE
		$key = str_replace("#", "", preg_replace("#ScratchHub translation file for language (.*) \((.*)\)#Uis", "$1", $po[0]));
		$_LOCALE[$key] = array();
		//Loop .po!
		foreach($po as $k => $line)	{
			//Remove comment lines
			if($line[0] == "#")	{
				unset($po[$k]);
			}
			//Remove lines which survived FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
			if(trim($line) == "")	{
				unset($po[$k]);
			}
			//Check if line is msgid
			if(strpos($line, "msgid") !== false)	{
				//Create new element in $_LOCALE
				$msgid = str_replace("msgid ", "", $line);
				$msgid = str_replace("\"", "", $msgid);
				$msgstr = str_replace("msgstr ", "", $po[$k + 1]);
				$msgstr = str_replace("\"", "", $msgstr);
				$_LOCALE[$key][$msgid] = $msgstr;
			}
		}
	}

	function __($msg, $args = null, $lang = null)	{
		global $_USER;
		global $_LOCALE;
		if(!is_string($lang))	{
			$lang = $_USER -> language;
		}
		if(!$args)	{
			$args = array();
		}
		if(isset($_LOCALE[$lang][$msg]))	{
			return vsprintf($_LOCALE[$lang][$msg], $args);
		}
		else	{
			return $msg;
		}
	}
?>