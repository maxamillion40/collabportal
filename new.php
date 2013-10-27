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
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
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
										<textarea name="desc"></textarea>
								</div>
								<!-- Third step -->
								<h3>Schritt 3: Einstellungen</h3>
								<div>
									<p>Sobald du dein Collab veröffentlicht hast, kannst du weitere Einstellungen in der <i>Verwaltung</i> machen.</p>
								</div>
								<button type="submit" class="button blue">Collab starten</button>
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