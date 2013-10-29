<?php
	session_start();
	require_once("includes/func.php");
	if(!is_loggedin() and (!isset($_SESSION["user"]) or $_SESSION["user"] != "webdesigner97" or $_SESSION["user"] != "lirex"))	{
		header("HTTP/1.1 403");
		header("Location: index.php?error=noaccess");
		exit;
	}
	//
	mysql_auto_connect();
	$news = mysql_get("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 0,3");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Adminbereich &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="index,follow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/maintenance.css" />
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
				<div class="cols clearfix" style="top: -10px; padding-left: 10px; padding-right: 10px;">
					<!-- Über -->	
						<article class="box ">
							<div class="box-head">
								<h4>Ankündigungen</h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										foreach($news as $entry)	{
											echo "<div class='news-entry'>";
											echo "<p>".$entry["date"]."</p>";
											echo "</div>";
										}
									?>
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