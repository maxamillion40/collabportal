<?php
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	if(is_loggedin()) {
		$user = $_SESSION['user'];
		$mycollabs = mysql_get("SELECT * FROM collabs WHERE `owner`='$user'");
	}
	else {
		die(header("Location: index.php?error=nologin"));
	}
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Meine Collabs &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/mystuff.css" />
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
					<!-- Hilfe -->	
						<article class="box ">
							<div class="box-head">
								<h3>Meine Collabs</h3><span id='newcollab'><a href='new.php'><button>+ Neues Collab</button></a></span>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										print_array($mycollabs);
										echo "<ul id='msu'>";
										if(count($mycollabs) > 0)	{
											//Collabliste
											foreach($mycollabs as $collab)	{
												echo "<li>";
												echo "<a href='collab.php?id=".$collab["id"]."'><img src='logos/".$collab["logo"]."' width='144' height='108' class='image' alt='".$collab["name"]."' /></a>";
												echo "<table class='stats'>";
													echo "<tr><td><b>Name:</b></td><td>".$collab["name"]."</td></tr>";
													echo "<tr><td><b>Status:</b></td><td>".$collab["status"]."</td></tr>";
													echo "<tr><td><b>Mitglieder:</b></td><td><ul class='cmembers'>";
													$collab["mitglieder"] = unserialize($collab["mitglieder"]);
													foreach($collab["mitglieder"]["people"] as $member) {
														echo "<li>".$member."</li>";
													}
												echo "</ul></td></tr></table></li><hr/>";
											}
										}
										else	{
											//Keine Collabs
											echo "Du hast noch keine Collabs erstellt. <a href='new.php'>Erstelle eins!</a>";
										}
										echo "</ul>";
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