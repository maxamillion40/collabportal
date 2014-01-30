<!DOCTYPE html>
<?php
	session_start();
	set_include_path($_SERVER["DOCUMENT_ROOT"]);
	require_once("includes/func.php");
	mysql_auto_connect();
	$class = mysql_get("SELECT `class` FROM `users` WHERE `name`='".$_SESSION["user"]."'");
	if($class[0]["class"] != "Moderator" and $class[0]["class"] != "Administrator")	{
		header("HTTP/1.1 403");
		header("Location: ../error403.php?error=noaccess");
		exit;
	}
	//
	$news = mysql_get("SELECT `id` FROM `news` ORDER BY `date` DESC");
	$questions = mysql_get("SELECT `id` FROM `faq` WHERE `answer`='unbeantwortet'");
	$users = mysql_get("SELECT `id` FROM `users`");
?>
<html>
	<head>
		<title>Adminbereich &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="../styles/main.css" />
		<link rel="stylesheet" href="../styles/cp.css" />
		<link rel="stylesheet" href="../styles/maintenance.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="../favicon.ico" />
		<!-- Scripts -->
		<script src="../scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="../scripts/init.js"></script>
		<script src="../scripts/maintenance.js"></script>
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
						<article class="box">
							<div class="box-head">
								<h3>Übersicht</h3><span class="box-header-button"><a href="../index.php"><button class="button blue">Zurück zum CollabPortal</button></a></span>
							</div>
							<div class="box-content">
								<div class="inner">
									<p>Dein Rang: <?php echo $class[0]["class"]; ?></p>
									<p><a href="news.php">Ankündigungen</a>: <?php echo count($news); ?>/3</p>
									<p><a href="faq.php">Fragen</a>: <?php echo count($questions); ?></p>
									<p><a href="users.php">Benutzer</a>: <?php echo count($users); ?></p>
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