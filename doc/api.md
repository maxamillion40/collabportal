# ScratchHub API reference

## Introduction
The API for ScratchHub offers an object-oriented way to extend the functionality of ScratchHub.
The PHP API is available on all pages, provided that loader.php has already been called.
Please seperate content-pages and dedicated scripts strictly! Put content-pages (those with HTML in it) in the home directory (./), dedicated scripts without HTML output into ./libs.

### Using action.php and /libs
If you need to call a script in /libs, link to `action.php?youraction` and add the following snippet before the header() calls at the bottom:
	```php
	if(isset($_GET["youraction"]))	{	
		include_once("libs/youraction.php");
		exit;
	}
	```

### Custom global objects
ScratchHub initializes some global objects to help access the Database and the current user. However, those objects should be global, but they are NOT superglobal!
When using them inside a function/method, don't forget to inform PHP about their use!
	```php
	public function whatever()	{
		global $_USER;
		global $_MYSQL;
		//Your code goes here
	}
	```

	- $_MYSQL	
	$_MYSQL provides an object to access the database (class mysqlConn; includes/db.php). It has to methods to read/write data: get and set.
	Use `$_MYSQL -> get("SELECT * FROM collabs WHERE id=?", array(2))` and add a `SELECT` query as param to receive data from the database.
	Use `$_MYSQL -> SET("INSERT INTO users(name) VALUES(?)", array("PeterPan"))`
	Never insert variables directly into the query
	to prevent MySQL injections, but mark the occurence in the query with question marks (?), then pass an array as second param to the function with all variables in it.

	- $_USER
	see [class user definition]

$_USER is a user object about the users who started your script.

### head generation
Don't create static heads on your pages, unless you really need to. Instead use the $_PAGE object to insert scripts, styles, meta, etc. How it works:
	- Setting metadata and title
	`$_PAGE -> setTitle("pagename", ["splitter"]);`			//sets title tag. Pattern: <title>$pagename $splitter CP_NAME</title>. If splitter is not provided, CP_TITLE_SPLITTER shows up.
	`$_PAGE -> setDescription("Description");`				//OPTIONAL! Set custom page description. If not used, CP_DESCRIPTION will show up.
	`$_PAGE -> addKeywords(array("keyword", "keyword"));`	//OPTIONAL! Add custom keywords to page. "scratch, collabs" are inserted automatically
	`$_PAGE -> setRobots(array("command1", "command2"));`	//Set robot commands, e.g. index/noindex, follow/nofollow
	
	- Including javascripts
	`$_PAGE -> useScript("scriptname")`;
		=> Possible values: jquery, jqueryui, tinymce, getUrlParam, tablesorter, scratchblocks OR custom path (e.g. scripts/myawesomescript.js)
	If pagename.js exists, it's loaded automatically!
	
	- Stylesheets
	Stylesheets are included automatically: main.css, cp.css and - if available - pagename.css!
	Include custom styles with:
	`$_PAGE -> useStyle("path/file.css");`
	
Having finished preparing the head, insert it to the page:
	```php
	<head>
		<?php
			$_PAGE -> putHeader();
		?>
	</head>
	```

### class user definition
Properties:
	```
	id (User ID in database)
	name (Nickname chosen by user during signup)
	pass (md5, password)
	mail (E-Mail given during signup)
	scratch (Scratch user account name)
	class (user class, see [user classes])
	last_login (time object of last login, see [class time definition])
	last_ip (IP of last login)
	language (language of user, format lang_COUNTRY)
	signup_date (time object of signup date, see [class time definition])
	lastcollab (time object of last collab, see [class time definition])
	```
	
Methods:
	boolean `is_online()`
	^ Returns true if user is logged in, false if not. DEPRECATED, use [user classes] instead

### class message definition
Properties:
	```
	id (Message ID in database)
	sender (user object of sender)
	to (user object of recipient)
	date (time object of sending time)
	regard (message regard)
	message (message body)
	read (true/false if message is opened)
	```

Methods:
	boolean `can_send()`
	^ Returns true if message contains required fields (sender, to, regard, msg), otherwise false
	null `send()`
	^ Saves message to database
	
### class collabmessage definition
Properties:
	```
	id (Message ID in database)
	time (time object of send time)
	sender (user object of who sended the message)
	collab (Collab ID to which the message belongs)
	msg (message body)
	censored (true/false if message censored by collab admin)
	internalID (Message ID in collab)
	```

Methods:
	none

### class page definition
Properties:
	```
	title (Page title prefix)
	description (Page description)
	keywords (array of additional keywords)
	robots (array of robots commands)
	scripts (array of javascript paths)
	styles (array of stylesheet paths)
	```

Methods:
	null `requires_rank(int $which, string $redirectOnInsufficient)`
	^ $which: See [user classes]
	^ $redirectOn...: Where the user should be redirected if his rank is insufficient.
	null `setTitle($prefix, [$split])`
	^ $prefix: <title> prefix
	^ $split: optional, used to split prefix an CP_NAME, Default: CP_TITLE_SPLITTER
	null `setDescription($desc)`
	^ Set page description to $desc
	null `addKeywords(array $keys)`
	^ Add additional keywords to standard keyword set
	null `setRobots(array $commands)`
	^ Set robot commands for current page.
	null `useScript(string $script)`
	^ Include a JavaScript library (see [Script definitions]) or a custom script path
	null `useStyle(string $style)`
	^ Include a custom stylesheet path
	null `putHeader()`
	^ Put head of page into sourcecode, doesn't include `<head>` tags.