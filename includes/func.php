<?php
	/* OBSOLETE! To be deleted soon */
	function errnotice($code,$message) {
		if($GLOBALS["err"] == $code) {
			echo "<span class='red'><span class='result-message'><span class='message-inner'>".$message."</span></span></span>";
		}
	}
	function resnotice($code,$message) {
		if($GLOBALS["res"] == $code) {
			echo "<span class='orange'><span class='result-message'><span class='message-inner'>".$message."</span></span></span>";
		}
	}
	function print_array(array $in)	{
		echo "<pre style='width: 100%; overflow-x: scroll; border: 1px orange dotted; padding: 10px;'>";
		print_r($in);
		echo "</pre>";
	}
	function get_uri()	{
		return "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	function get_include_contents($filename) {
		if (is_file($filename)) {
			ob_start();
			include $filename;
			return ob_get_clean();
		}
		return false;
	}
?>