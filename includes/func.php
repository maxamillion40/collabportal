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
	
?>