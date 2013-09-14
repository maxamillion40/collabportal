<?php
	session_start();
	require_once("includes/func.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Über &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/about.css" />
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
				<div class="cols clearfix" style="top: -10px; padding-left: 10px; padding-right: 10px;">
					<!-- Über -->	
						<article class="box ">
							<div class="box-head">
								<h4>Über das Collabportal</h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<h4>Geschichte</h4>
										Das Collabportal wurde am 03.02.2013 von webdesigner97 ins Leben gerufen, um das deutsche Scratchforum zu entlasten und die Verwaltung von Collabs zu vereinfachen. 
										Es ist seit dem 12.08.2013 im Zuge der Umrüstung auf das aktuelle Design von Scratch eine Zusammenarbeit von webdesigner97 und Lirex. 
										Bei Fragen kannst du dich gerne <a href="./" >hier</a> an diese wenden, oder am besten erst einmal in der Hilfe nachschauen.
									<hr/>
									<h4>Zukünftige Pläne</h4>
										<ul>
											<li>Englischsprachige Version</li>
											<li>Passwortreset per E-Mail</li>
										</ul>
										Zögere nicht, Vorschläge für neue Funktionen des CollabPortals <a href="./" >hier</a> einzureichen.
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