<?php
	header("HTTP/1.1 404 Not Found");
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	$featured = mysql_get("SELECT * FROM featured_collab");
	mysql_close();
	
	$url = "http://" . $_SERVER["SERVER_NAME"] . "/collabs2";
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
		<link rel="stylesheet" href="<?php echo $url; ?>/styles/main.css" />
		<link rel="stylesheet" href="<?php echo $url; ?>/styles/cp.css" />
		<link rel="stylesheet" href="<?php echo $url; ?>/styles/error404.css" />
		<link rel="stylesheet" href="<?php echo $url; ?>/styles/scratchblocks2.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo $url; ?>/favicon.ico" />
		<!-- Scripts -->
		<script src="<?php echo $url; ?>/scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="<?php echo $url; ?>/scripts/init.js"></script>
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
								<div class="blocks scratchblocks2-container">
									<div class="script">
										<div class="cwrap control cap">
											<div class="stack control cstart">If <div class="boolean operators"><div class="boolean obsolete">Seite nicht gefunden</div> and <div class="boolean operators">not <div class="boolean obsolete">vertippt</div></div></div></div><div class="comment attached"><div>Klick mich</div></div>
											<div class="cmouth">
												<div class="stack motion" style="cursor:pointer;" onClick="history.back();">Gehe zur vorherigen Seite</div></a>
												<div class="stack motion" style="cursor:pointer;" onClick="navigate('<?php echo $url; ?>/index.php');">Gehe zur Startseite</div>
												<div class="stack motion" style="cursor:pointer;" onClick="navigate('http://scratch.mit.edu');">Scratch on!</div>
											</div>
											<div class="stack cend control"></div>
										</div>
									</div>
								</div>
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