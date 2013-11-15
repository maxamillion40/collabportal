<?php
	session_start();
	require_once("includes/func.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Das Team &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/team.css" />
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
								<h3>Das Team</h3>
							</div>
							<div class="box-content">
								<div class="inner">
									<h3>Administratoren</h3>
										<img src="http://cdn.scratch.mit.edu/get_image/user/909333_75x75.png?v=1367988496.15" width="75px" /><div class="desc"><h4>webdesigner97</h4>
										<p>webdesigner97 ist Gründer und Hauptadministrator des Collabportals. Bei der Entwicklung übernimmt er viele grundlegende Aufgaben, bspw. die Pflege der
										Datenbank, Ausarbeitung neuer Funktionen und die Arbeit "unter der Motorhaube". Nutzer können sich bei Problemen, Fragen, Kritik und Ideen jederzeit an ihn wenden.</p></div>
										<img src="http://cdn.scratch.mit.edu/get_image/user/1900672_75x75.png?v=1380467242.62" width="75px" /><div class="desc"><h4>Lirex</h4>
										<p>Lirex stieß am 8. August 2013 dazu, nachdem er die Entwicklung des Collabportals seit den Anfängen Ende 2012 mitverfolgt hatte.
										Er ist für diverse Texte und Grafiken, die FAQ und für das Design zuständig. Zudem moderiert Lirex das Collabportal und ist Ansprechpartner bei Problemen.</p></div>
									<h3>Moderatoren</h3>
									<h3>Tester</h3>
										<div class="t-block">T<div class="rotate">Tester</div></div><div class="desc"><h4>akhof</h4>
										<p>akhof war der erste Tester des Collabportals und ist permanenter Tester der pre-Beta.</p></div>
									<h3>Betatester</h3>
										<ul class="desc">
											<li>Ominöse Person</li>
										</ul>
									<h3>Danke außerdem an:</h3>
										<ul class="desc">
											<li>LiFaytheGoblin (Logo, Ideengeberin)</li>
											<li>Das Scratch Team (Bereitstellung des Designs)</li>
										</ul>
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