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
	$questions = mysql_get("SELECT * FROM `faq` ORDER BY `id` DESC");
	$class = mysql_get("SELECT `class` FROM `users` WHERE `name`='".$_SESSION["user"]."'");
?>
<html>
	<head>
		<title>FAQ Verwaltung &raquo; ScratchCollabs in DACH</title>
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
								<h3><a href="index.php">Übersicht</a> &rarr; FAQ Einträge</h3>
							</div>
							<div class="box-content">
								<div class="inner box-no-padding">
									<?php
										foreach($questions as $q)	{
											$addclass = "";
											if($q["answer"] == "unbeantwortet")	{
												$addclass = "no-answer";
											}
											echo "<div class='question $addclass'>";
											echo "<form action='../action.php?answer&id=".$q["id"]."' method='post'>";
											echo "Frage: <input style='width:500px;' type='text' name='question' required value='".$q["question"]."' /></p>";
											echo "Antwort: <input style='width:500px;' type='text' name='answer' required value='".$q["answer"]."' />";
											echo "<input type='submit' class='button blue' value='Frage beantworten' />";
											echo "<a href='../action.php?delq&id=".$q["id"]."'><button type='button' class='button grey'>Frage Löschen</button></a>";
											echo "</form>";
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