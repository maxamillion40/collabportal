<?php
	session_start();
	set_include_path("./includes/");

	require_once("func.php");
	require_once("locale.php");
	require_once("db.php");
	require_once("classes.php");
	
	//mixed set_error_handler(callback $error_handler [, int $error_types = E_ALL | E_STRICT ]);
?>