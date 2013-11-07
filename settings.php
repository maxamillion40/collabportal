<?php
	session_start();
	require_once("includes/func.php");
	if(!is_loggedin())	{
		die(header("Location: index.php?error=nologin"));
	}
	mysql_auto_connect();
	$user = mysql_get("SELECT `mail` FROM `users` WHERE `name`='".$_SESSION["user"]."'");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Profileinstellungen &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/settings.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
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
				<!-- div für obere boxen -->
				<div class="cols clearfix" style="top: -10px; padding-left: 10px; padding-right: 10px;">
					<!-- Liste -->	
						<article class="box ">
							<div class="box-head">
								<h3>Profileinstellungen</h3>
							</div>
							<div class="box-content">
								<div class="inner">
									<h3>E-Mailadresse</h3>
									<form action="action.php?setmail" method="post">
										<p>Hier kannst du deine E-Mailadresse ändern, falls sie sich geändert haben sollte.</p>
										<p>E-Mailadresse: <input style="display: inline;" type="email" name="mail" value="<?php echo $user[0]["mail"]; ?>" /></p>
										<button class="button blue">Speichern</button>
									</form>
									<!-- # -->
									<h3>Passwort</h3>
									<form action="action.php?setpass" method="post">
										<p>Zu deiner eigenen Sicherheit solltest du dein passwort regelmäßig ändern. Bitte denke daran, dass du nicht das gleiche Passwort wie auf scratch.mit.edu verwenden solltest.</p>
										<input type="password" name="old" placeholder="Altes Passwort" required />
										<input type="password" name="new" placeholder="Neues Passwort" required />
										<input type="password" name="new-2" placeholder="Passwort bestätigen" required />
										<button class="button blue">Speichern</button>
									</form>
								</div>
							</div>
						</article>
					</div>
				</div>
		</div>
		<!-- Footer -->
		<?php
			include_once("includes/footer.php");
		?>
		</div>
	</body>
</html>