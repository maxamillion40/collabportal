<header>
	<div class="container">
		<!-- Logo -->
		<a href="./" class="logo" id="trans"><span class="scratch"></span></a>
		<!-- Nav -->
		<ul class="site-nav">
			<li><a href="new.php">Neues Collab</a></li>
			<li><a href="./">Java</a></li>
			<li><a href="./">C++</a></li>
			<li><a href="./">Delphi</a></li>
			<?php
		        $res = "";
				if(isset($_GET["result"]))	{
					$res = $_GET["result"];
				}
				$uname = "";
				if(isset($_GET["uname"]))	{
					$uname = $_GET["uname"];
				}
				    if($res == "login") {
                        echo "<span class='result-message'>Willkommen zur&uuml;ck! Du bist nun eingeloggt.</span>";
                    }
                    if($res == "logout") {
                        echo "<span class='result-message'>Du wurdest ausgeloggt. Bis bald!</span>";
                    }
                    if($res == "censored") {
                        echo "<span class='result-message'>Die Nachricht wurde Zensiert.</span>";
                    }
				if(is_loggedin())	{
					echo "<li id='welcome'><a>Willkommen, ".$_SESSION["user"]."</a></li>";
					echo "<li id='bye'><a href='action.php?logout'><img src='img/logout.png' height='35' /><br/><span id='logout-sign'>Logout</span></a></li>";
				}
				else	{
					echo "<li id=\"join\">
							<a>Mitmachen!</a>
							<div id=\"login\">
								<div id=\"arrow\"></div>
								<div id=\"form\">
									<form action=\"action.php?login\" method=\"post\">
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