<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
?>
<html>
	<head>
		<title>Kontakt &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/contact.css" />
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
								<h3>Kontakt</h3>
							</div>
							<div class="box-content">
								<div class="inner">
									<p><h4>Über dieses Formular kannst  du uns kontaktieren</h4></p>
									<form id="contact" action="./">
										<?php
											if(!$_USER -> is_online()) {
												echo "<p>Gib eine E-Mailadresse an, unter der wir dich erreichen können, oder melde dich an.</p>";
												echo "<input type='email' name='email' placeholder='Gib deine E-Mail Adresse hier ein' required />";
											}
										?>
										<p>Wähle eine Kategorie aus, damit deine Anfrage schneller und genauer bearbeitet werden kann.</p>
										<select name="category">
											<option>-</option>
											<option>Fehler/Probleme</option>
											<option>Fragen</option>
											<option>Anregungen/Feedback</option>
											<option>Sonstiges</option>
										</select><br/>
										<p>Gib deine Nachricht hier ein.</p>
										<textarea width="500px" height="250px" id="msg-input" placeholder="Nachricht" name="message" required></textarea>										
										<p>Wenn du fertig bist, klicke auf "Absenden". Bedenke, dass die Beantwortung deiner Anfrage einige Tage dauern kann.</p>
										<input type="submit" class="button blue" value="Absenden" />
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