<?php
	function cp_handle_errors($errcode, $errstring, $errfile, $errline)	{
		$ref = $_SERVER["HTTP_REFERER"];
		//
		echo __("Sorry, but an error occured while trying to execute the requested action.") . "<br />";
		echo __("If this is the first time you see this message, ignore it and try again.") . "<br />";
		echo __("If the error remains, you should report it using the following form.") . "<br /><br />";
		echo __("Technical information") . "<br />";
		echo "<pre><strong>$errstring</strong> in $errfile on line <strong>$errline</strong></pre>";
		
		echo "<form action='action.php?reporterror' method='POST'>";
		echo "<input type='text' name='username' value='" . $_SESSION["user"] . "' /><br />";
		echo "<input type='text' name='time' value='" . date("d.m.Y H:i:s") . "' /><br />";
		echo "<input readonly type='text' name='error' value='$errstring in $errfile on line $errline' /><br />";
		echo "<input type='text' name='browser' value='" . $_SERVER["HTTP_USER_AGENT"] . "' /><br />";
		echo "<textarea name='notes' placeholder='Do you want to tell us something else?'></textarea><br />";
		echo "<input type='submit' value='Submit' />";
		echo "</form>";
		exit;
	}
	
	set_error_handler("cp_handle_errors", E_STRICT);
?>