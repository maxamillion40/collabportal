<?php
	session_destroy();
	unset($_USER);
	header("Location: index.php?result=logout");
?>