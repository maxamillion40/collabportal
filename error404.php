<?php
	header("HTTP/1.1 404 Not Found");
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	$featured = mysql_get("SELECT * FROM featured_collab");
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Verlaufen?  &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/error404.css" />
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
				<article class="box">
					<div class="box-head">
						<h4>Route 404 - Falsch abgebogen?</h4>
					</div>
					<div class="box-content" id="box-404">
						<div class="inner">
							<p class="centered">Wir haben unser Bestes gegeben, aber diese Seite konnten wir einfach nicht finden...</p>
							<p class="centered">Hast du dich vielleicht vertippt oder hast du einen sehr alten Link benutzt?</p>
							<div id="box404">
								<img src="img/script404.png" width="305" height="129" border="0" usemap="#map" />
								<map name="map">
									<area shape="rect" coords="14,39,146,63" href="index.php" alt="Zurück zu Startseite" />
									<area shape="rect" coords="14,63,184,88" href="javascript: history.back();" alt="Zurück zur vorherigen Seite" />
									<area shape="rect" coords="0,100,77,130" href="http://scratch.mit.edu" alt="Scratch on!" />
								</map>
							</div>
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