<?php
	session_start();
	require_once("includes/func.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Hilfe &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="index,follow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/help.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/init.js"></script>
	</head>
	<body>
		<script>
			function scrollup () {
				if (location.hash)
					window.scrollBy(0, -40);
			}
			function lscrollup () {
				window.setTimeout('window.scrollBy(0, -40)',10);
			}
			window.onload = scrollup;
		</script>
		<div id="pagewrapper">
			<!-- This is the blue box on the top of the site -->
				<?php
					include_once("includes/topnav.php");
				?>
			<!-- Main Content -->	
			<div class="container" id="content">
				<div class="cols clearfix" style="top: -10px; padding-left: 10px; padding-right: 10px;">
					<!-- Hilfe -->
						<article class="box">
							<div class="box-head">
								<h4>Hilfe</h4>
							</div>
							<div class="box-content" style="height: auto;">
								<div class="inner">
									<h3>Kurzhilfe</h3>
										<p>Hier wird bald eine Kurzanleitung zur Benutzung des CollabPortals folgen.</p>
									<h3>Wiki-Artikel</h3>
										<p>Das CollabPortal hat auch einen Artikel im deutschsprachigen Scratch-Wiki: <a href="http://scratch-dach.info/wiki/CollabPortal" >http://scratch-dach.info/wiki/CollabPortal</a>.</p>
									<hr/>
									<h3>FAQ</h3>
										<p>Du hast eine Frage? Stelle sie <a href="./">hier</a> oder <a href="contact.php">kontaktiere uns</a>!<br/>Klicke auf die Überschriften, um einen Permalink zu erhalten.</p>
										<!-- Hier kommt später mal PHP-Code hin, damit Fragen und Antworten vom Admin über die Datenbank hinzugefügt werden können. -->
									<div id="questions">
										<div id="1"><a href="help.php#1" onclick="lscrollup()"><h4>Was ist das Collabportal?</h4></a>
											<p>Siehe: <a href="about.php">Über ScratchCollabs</a>.</p></div>
										<div id="2"><a href="help.php#2" onclick="lscrollup()"><h4>Was ist Scratch?</h4></a>
											<p>Siehe: <a href="http://scratch.mit.edu/about" >Über Scratch</a>.</p></div>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
											b<br>
									</div>
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