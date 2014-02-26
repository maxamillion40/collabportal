<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	$questions	= $_MYSQL -> get("SELECT * FROM faq WHERE `answer`!='unbeantwortet' ORDER BY `id` ASC");
?>
<html>
	<head>
		<title><?php echo __("Help"); ?> &raquo; ScratchCollabs in DACH</title>
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
								<h4><?php echo __("Help"); ?></h4>
							</div>
							<div class="box-content" style="height: auto;">
								<div class="inner">
									<h3><?php echo __("Quick help"); ?></h3>
										<p>Hier wird bald eine Kurzanleitung zur Benutzung des CollabPortals folgen.</p>
									<h3><?php echo __("Scratchwiki article"); ?></h3>
										<p>Das CollabPortal hat auch einen Artikel im deutschsprachigen Scratch-Wiki: <a href="http://scratch-dach.info/wiki/CollabPortal" >http://scratch-dach.info/wiki/CollabPortal</a>.</p>
									<hr/>
									<h3><?php echo __("FAQ"); ?></h3>
										<p><?php echo __("Got a question?"); ?> Stelle sie <a href="#nq" onclick="lscrollup()">unten</a> oder <a href="contact.php">kontaktiere uns</a>!<br/><?php echo __("Click the headlines to get a permalink."); ?>.</p>
										<!-- Hier kommt später mal PHP-Code hin, damit Fragen und Antworten vom Admin über die Datenbank hinzugefügt werden können. -->
									<div id="questions">
									<?php
									foreach($questions as $question) {
										echo "<div id='".$question["id"]."'><a href='help.php#".$question["id"]."' onclick=\"lscrollup()\"><h4>".$question["question"]."</h4></a>";
										echo "<p>".$question["answer"]."</p></div>";
									}
									echo "<h4>" . __("Ask a question") . "</h4>";
									if($_USER -> is_online()) {
										echo "<form id='nq' action='action.php?newquestion' method='post'>";
										echo "<input type='text' name='question' placeholder='" . __("Question (max 255 chars)") . "' title='" . __("Ask a question") . "' required maxlength='255' tabindex='1' />";
										echo "<input type='submit' class='button blue' value='" . __("Send") . "' tabindex='3' />";
										echo "</form>";
									}
									else {
										echo __("Sorry, only registered users can use this function...");
									}
									?>
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