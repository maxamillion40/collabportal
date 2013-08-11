<?php
	session_start();
	require_once("includes/func.php");
	if(!is_loggedin())	{
		header("Location: join.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Neues Collab &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/homepage.css" />
		<link rel="stylesheet" href="styles/jquery-ui-1.10.3.custom.min.css" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/jqueryui/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="scripts/tinymce/tinymce.min.js"></script>
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
					<div class="box-header">
						<h2>Neues Collab erstellen</h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<form action="action.php?new" method="post">
								<!-- First step -->
								<h3>Schritt 1: Collabname</h3>
								<div>
									<p>Überlege dir einen aussagekräftigen Namen für dein Collab, der auch einen ersten Hinweis auf das Projekt gibt (z.B. "Stadtsimulation")</p>
									<input type="text" name="collabname" placeholder="Collabname" required />
								</div>
								<!-- Second step -->
								<h3>Schritt 2: Beschreibung</h3>
								<div>
									<p>Beschreibe dein Collab möglichst genau, erwähne auch das Ziel und die die Inhalte der gemeinsamen Arbeit</p>
										<textarea name="desc" required></textarea>
								</div>
								<!-- Third step -->
								<h3>Schritt 3: Einstellungen</h3>
								<div>
									<p>Du kannst noch einige weitere Einstellungen machen</p>
									<input type="number" name="max_members" placeholder="Maximale Mitgliederzahl" min="2" max="100" step="1" />
								</div>
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