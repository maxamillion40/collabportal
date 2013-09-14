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
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/help.css" />
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
					<!-- Hilfe -->
						<article class="box ">
							<div class="box-head">
								<h4>Hilfe</h4>
							</div>
							<div class="box-content" style="height: auto;">
								<div class="inner">
									<h4>Kurzhilfe</h4>
										Hier wird bald eine Kurzanleitung zur Benutung des CollabPortals folgen.
									<h4>Wiki-Artikel</h4>
										Das CollabPortal hat auch einen Artikel im <a href="http://scratch-dach.info" >deutschsprachigen Scratch Wiki</a>: <a href="http://scratch-dach.info/wiki/CollabPortal" >http://scratch-dach.info/wiki/CollabPortal</a>.
									<h4>FAQ</h4>
										Hier werden häufig gestellte Fragen beantwortet werden, zur Zeit wurden aber noch nicht besonders viele gestellt.
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