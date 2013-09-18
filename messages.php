<?php
	session_start();
	require_once("includes/func.php");
	if(!is_loggedin())	{
		header("Location: index.php");
	}
	mysql_auto_connect();
	$unread = count(mysql_get("SELECT * FROM `messages` WHERE `to`='".$_SESSION["user"]."'"));
	$msg = mysql_get("SELECT * FROM `messages` WHERE `to`='".$_SESSION["user"]."'");
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Posteingang  &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
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
				<article class="box">
					<div class="box-head">
						<h4>Posteingang</h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<p>Du hast <?php echo $unread; ?> ungelesene Nachrichten!</p>
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