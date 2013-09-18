﻿<?php
	require_once("func.php");
	$return_to = get_uri();
?>
<header>
	<div class="container">
		<!-- Logo -->
		<a href="./" class="logo" id="trans"><span class="scratch"></span></a>
		<!-- Nav -->
		<ul class="site-nav">
			<li><a href="http://scratch.mit.edu/projects/editor/">Entwickeln</a></li>
			<li><a href="http://scratch.mit.edu/explore/?date=this_month">Entdecken</a></li>
			<li><a href="http://scratch.mit.edu/discuss/13/">Diskutieren</a></li>
			<li class="addborder"><a href="./">Hilfe</a></li>
			<?php
		        $res = "";
				if(isset($_GET["result"]))	{
					$res = $_GET["result"];
				}
				$err = "";
				if(isset($_GET["error"]))	{
					$err = $_GET["error"];
				}
				$uname = "";
				if(isset($_GET["uname"]))	{
					$uname = $_GET["uname"];
				}
				$name = "";
				if(isset($_GET["name"]))	{
					$name = $_GET["name"];
				}
				
                    require_once("includes/notices.php");
					
				if(is_loggedin())	{
					echo "<li id='msg-icon'><a><img src='img/msg.png' alt='Msg' /></a></li>";
					echo "<li id='welcome'><a>Willkommen, ".$_SESSION["user"]."</a></li>";
					echo "<div id='amenu'><li id='bmenu'><a><img id='mbn' src='img/menu2.png' height='35' /></a></li>
                            <ul id='menulink'>
                                <li><a href='mystuff.php'>Meine Collabs</a></li><br/>
								<li><a>Profil</a></li><br/>
                                <li><a href='about.php'>Das CollabPortal</a></li><br/>
								<li><a href='help.php'>Hilfe</a></li><br/>
								<li id='bye'><a href='action.php?logout'><img id='lbn' src='img/Orb4.png' height='35' /><span id='logout-sign'>Logout</span></a></li>
                            </ul></div>";
				}
				else	{
					echo "<li id=\"join\">
							<a>Mitmachen!</a>
							<div id=\"login\">
								<div id=\"arrow\"></div>
								<div id=\"form\">
									<form action=\"action.php?login&return=$return_to\" method=\"post\">
										<input type=\"text\" name=\"name\" placeholder=\"Nutzername\" required value=\"".$uname."\" />
										<input type=\"password\" name=\"pass\" placeholder=\"Passwort\" required />
										<input type=\"submit\" value=\"Login\" class=\"button grey\" />
										<a href=\"join.php\">Neu hier?</a>
									</form>
								</div>
							</div>
					</li>";
				}
			?>
		</ul>
	</div>
</header>