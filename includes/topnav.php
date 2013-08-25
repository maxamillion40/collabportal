<header>
	<div class="container">
		<!-- Logo -->
		<a href="./" class="logo" id="trans"><span class="scratch"></span></a>
		<!-- Nav -->
		<ul class="site-nav">
			<li><a href="new.php">Neues Collab</a></li>
			<li><a href="./">Meine Collabs</a></li>
			<li><a href="./">Hilfe</a></li>
			<li><a href="./">Scratch</a></li>
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
				
                function errnotice($code,$message) {
		            if($GLOBALS["err"] == $code) {
                    echo "<span class='red'><span class='result-message'>".$message."</span></span>";
                    }
                }
                function resnotice($code,$message) {
		            if($GLOBALS["res"] == $code) {
                    echo "<span class='orange'><span class='result-message'>".$message."</span></span>";
                    }
                }
				    /* Benachrichtigungen */
				    resnotice("login","Willkommen zur&uuml;ck!");
                    resnotice("logout","Du wurdest ausgeloggt. Bis bald!");
                    resnotice("censored","Die Nachricht wurde zensiert!");
                    resnotice("msgok","Deine Nachricht wurde gespeichert!");
                    /* Fehlermeldungen */
                    errnotice("notin","Du bist kein Mitglied in diesem Collab!");
                    errnotice("alreadyin","Du bist bereits Mitglied in diesem Collab!");
                    errnotice("own","Du kannst aus deinem Collab nicht austreten!");
					errnotice("notext","Du hast keine Nachricht eingegeben!");
					errnotice("nologin","Logge dich ein, um Collabs zu betrachten!");
					errnotice("noid","Interner Fehler, konnte Nachricht nicht zuordnen!");
					errnotice("unknownuser","Dieser Nutzer existiert nicht!");
					errnotice("badpass","Falsches Passwort oder Nutzername!");
					
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