<?php
	/**
		Static CP class for CP related funtions, cannot be initiated.
	*/
	class CP	{
		private function __construct() {}
		
		const NAME = "ScratchHub";
		const DESCRIPTION = "Lorem Ipsum dolor sit amet";
		const KEYWORDS = "scratch, collabs";
		const TITLE_SPLITTER = "&raquo;";
		const GITHUB_REPO = "https://github.com/webdesigner97/collabportal";
		const ADMINS_MAIL = "Christian_D_97@gmx.de, alex-zimmer@online.de";
		const BR = "\r\n";
		
		const USER_GUEST = 0;
		const USER_MEMBER = 1;
		const USER_MODERATOR = 2;
		const USER_ADMIN = 3;
		
		const DB_USER = "root";
		const DB_PASS = "";
		const DB_NAME = "scratchcollabs";
		const DB_SERVER = "localhost";
	}
?>