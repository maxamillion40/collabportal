<?php
	/**
		* Loads localisation files.
		* This file loads the localisation files into the `$_LOCALE` and defines `__()` for translating strings
		* @package includes
	*/
	$_LOCALE = array();
	$files = scandir($_HOME . "/locale");
	unset($files[0]);
	unset($files[1]);
	
	foreach($files as $l)	{
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

	/**
		* Translate a string.
		* Translate a string to the language of `$_USER` or another language by passing the 3rd param.
		* @param string $msg The string to be translated. If the translation can't be found, the original string is returned
		* @param array $args If the string contains variables, pass them using this array
		* @param string $lang optional, translate to a certain language
		* @see http://de.php.net/manual/en/function.sprintf.php#refsect1-function.sprintf-parameters How to mark variables in $msg
		* @since 2014-08-20
		* @api
		* @return string
	*/
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