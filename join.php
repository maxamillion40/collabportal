<?php
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	$featured = mysql_get("SELECT * FROM featured_collab");
	mysql_close();
	if(is_loggedin())	{
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Registrieren &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/jquery-ui-1.10.3.custom.min.css" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/jqueryui/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="scripts/init.js"></script>
	</head>
	<body>
		<div id="pagewrapper">
			<!-- This is the blue box on the top of the site -->
				<?php
					include_once("includes/topnav.php");
				?>
			<!-- Main Content -->	
			<div class="container" id="content">
			<?php
				if(isset($_GET["error"]))	{
					if($_GET["error"] == "namenotavailable")	{
						echo "<div class='ui-state-error'>Dieser Nutzername ist nicht verfügbar!</div>";
					}
					if($_GET["error"] == "badmail")	{
						echo "<div class='ui-state-error'>Das scheint keine gültige Email Adresse zu sein. Eine Email Adresse braucht ein '@' und mindestens einen '.'!</div>";
					}
					if($_GET["error"] == "badprofile")	{
						echo "<div class='ui-state-error'>Dieses Scratchprofil existiert nicht!</div>";
					}
					if($_GET["error"] == "badpass")	{
						echo "<div class='ui-state-error'>Die Passwörter stimmen nicht überein!</div>";
					}
					if($_GET["error"] == "badpasslogin")	{
						echo "<div class='ui-state-error'>Das Passwort war leider nicht korrekt!</div>";
					}
					if($_GET["error"] == "unknownuser")	{
						echo "<div class='ui-state-error'>Dieser Nutzer ist leider nicht bekannt!</div>";
					}
					if($_GET["error"] == "mailnotavailable")	{
						echo "<div class='ui-state-error'>Es hat sich bereits jemand mit dieser Emailadresse registriert!</div>";
					}
				}
				if(isset($_GET["result"]))	{
					//
				}
			?>
				<article class="box">
					<div class="box-head">
						<h4>Registrieren</h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<p>
								Die Registrierung im CollabPortal ist zu 100% kostenlos und wir geben deine Daten nicht weiter. Bitte beachte, dass dies kein offizielles Projekt des Scratch Teams ist.
								Merke dir dein Passwort gut, wenn es einmal gesetzt wurde, können wir es dir nicht mehr mitteilen, denn es wird verschlüsselt gespeichert!
							</p>
							<form action="action.php?signup" method="post">
								<input value="<?php if(isset($_GET["name"])) {echo $_GET["name"];} ?>" type="text" name="name" placeholder="Gewünschter Nutzername" required autocomplete="off" title="Mit welchem Namen möchtest du dich hier anmelden und mit anderen Scratchern schreiben?" autofocus tabindex="1" />
								<input value="<?php if(isset($_GET["email"])) {echo $_GET["email"];} ?>" type="email" name="email" placeholder="Deine Email Adresse" required autocomplete="off" title="Deine Email Adresse brauchen wir nur, um Mehrfachanmeldungen zu verhindern." tabindex="2" />
								<input value="<?php if(isset($_GET["scratch"])) {echo $_GET["scratch"];} ?>" type="text" name="scratch" placeholder="Dein Scratch Account" required autocomplete="off" title="Wie lautet dein Nutzername auf Scratch?" tabindex="3" />
								<input type="password" name="pass" placeholder="Passwort"  required autocomplete="off" title="Dein Passwort sollte nicht das gleiche sein wie bei Scratch." tabindex="4" />
								<input type="password" name="pass_check" placeholder="Passwort wiederholen" required autocomplete="off" title="Bitte das Passwort wiederholen." tabindex="5" />
								<label><input type="checkbox" name="rules" value="accept" required title="Wirklich?" tabindex="6" /> Nutzungsbedingungen gelesen und akzeptiert</label>
								<input type="submit" class="button grey" value="Registrieren" tabindex="7" />
							</form>
						</div>
					</div>
				</article>
			</div>
			<!-- Footer -->
			<?php
				include_once("includes/footer.php");
			?>
		</div>
	</body>
</html>