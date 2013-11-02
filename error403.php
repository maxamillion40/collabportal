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
		<title>Einbahnstraße  &raquo; ScratchCollabs in DACH</title>
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
						<h4>Hier hättest du nicht hinkommen sollen...</h4>
					</div>
					<div class="box-content" id="box-404">
						<div class="inner">
							<p class="centered">Eigentlich hast du auf dieser Seite nichts zu suchen...</p>
							<p class="centered">Wie bist du denn hierher gekommen?</p>
							<div id="box404">
								<div class="blocks scratchblocks2-container">
									<div class="script">
										<div class="cwrap control cap">
											<div class="stack control cstart">If <div class="boolean operators">not <div class="boolean sensing">Nutzer <div class="dropdown"><?php if(is_loggedin()) { echo $_SESSION["user"]; } else { echo "Anonym"; } ?></div> hat Zugriff</div></div></div><div class="comment attached"><div>Klick mich</div></div>
											<div class="cmouth">
												<div class="stack sensing">Frage <div class="string">Warum bist du hier?</div> und warte</div></a>
												<div class="stack motion" style="cursor:pointer;" onClick="navigate('<?php echo $url; ?>/index.php');">Gehe zur Startseite</div>
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