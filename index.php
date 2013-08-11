<?php
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	$featured	= mysql_get("SELECT * FROM featured_collab");
	$collabs	= mysql_get("SELECT * FROM collabs WHERE `status`='open'");
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Start &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/jquery-ui-1.10.3.custom.min.css" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/jqueryui/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="scripts/init.js"></script>
	</head>
	<body onLoad="nojs">
		<div id="pagewrapper">
			<!-- This is the blue box on the top of the site -->
				<?php
					include_once("includes/topnav.php");
				?>
			<!-- Main Content -->	
			<div class="container" id="content">
				<noscript><div class="ui-state-error">Um die Funktionen des CollabPortals in vollem Umfang nutzen zu können, musst du JavaScript aktivieren.</div><br /></noscript>
			<?php
				if(isset($_GET["error"]))	{
					if($_GET["error"] == "nologin")	{
						echo "<div class='ui-state-error'>Bitte logge dich ein, um Collabs zu betrachten!.</div>";
					}
					if($_GET["error"] == "noid")	{
							echo "<div class='ui-state-error'>Interner Fehler, konnte Nachricht nicht zuordnen!</div>";
					}
					if($_GET["error"] == "unknownuser")	{
							echo "<div class='ui-state-error'>Dieser Nutzer ist uns nicht bekannt. Vertippt?</div>";
					}
					if($_GET["error"] == "badpass")	{
							echo "<div class='ui-state-error'>Dieses Passwort scheint nicht zum angegebenen Nutzernamen zu passen. Vertippt?</div>";
					}
				}
				if(isset($_GET["result"]))	{
					if($_GET["result"] == "login")	{
						echo "<div class='ui-state-highlight'>Willkommen zurück! Du bist nun eingeloggt!</div>";
					}
					if($_GET["result"] == "logout")	{
						echo "<div class='ui-state-highlight'>Du bist nun ausgeloggt! Bis bald!</div>";
					}
					if($_GET["result"] == "signup")	{
						echo "<div class='ui-state-highlight'>Dein Account wurde angelegt, ".$_GET["name"].". Du kannst dich nun einloggen!</div>";
					}
				}
			?>
				<!-- div für obere boxen -->
				<div class="cols clearfix" style="top: -10px;">
					<!-- 1. Box -->
					<div class="col-9">	
						<article style="max-height: 315px;" class="box ">
							<div class="box-head">
								<h4>Vorgestelltes Collab</h4>
								<a class="right" title="Hier wird das letzte erfolgreich beendete Collab vorgestellt.">?</a>
							</div>
							<div class="box-content" style="height: 279px;">
								<div class="inner">
									<?php
										if(count($featured > 0))	{
											echo "<table id='featured-collab'>";
											echo "<tr>";
											echo "<td>";
											echo "<a href='".$featured[0]["url"]."'><img class='image' src='".$featured[0]["img"]."' alt='".$featured[0]["name"]."' height='180' width='240' /></a>";
											echo "</td>";
											echo "<td>";
											echo "<a href='".$featured[0]["url"]."' id='featured-h'>".$featured[0]["name"]."</a>";
											echo "<div id='featured-desc'>".$featured[0]["desc"]."</div>";
											echo "</td>";
											echo "</tr>";
											echo "<tr>";
											echo "<td colspan='2'>";
											echo "von: ".$featured[0]["mitglieder"];
											echo "</td>";
											echo "</tr>";
											echo "</table>";
										}
									?>
								</div>
							</div>
						</article>
					</div>
					<!-- 2. Box -->
					<div class="col-7">	
						<article style="max-height: 315px;" class="box ">
							<div class="box-head">
								<h4>Ankündigungen</h4>
							</div>
							<div class="box-content" style="height: 279px;">
								<div class="inner">
									
								</div>
							</div>
						</article>
					</div>
				</div>
			<article class="box" >
				<div class="box-head">
					<h4>Aktive Collabs (<?php echo count($collabs); ?>)</h4>
				</div>
				<div class="box-content slider-carousel">
					<div class="viewport">
						<ul style="width: 100%; overflow: hidden; left: 0px;">
							<?php
								if(count($collabs) > 0)	{
									//Create a list of all collabs
									foreach($collabs as $collab)	{
										echo "<li class='project thumb item'>";
										if(is_loggedin())	{
											echo "<a href='collab.php?id=".$collab["id"]."'><img src='logos/".$collab["logo"]."' width='144' height='108' class='image' alt='".$collab["name"]."' /></a>";
										}
										else	{
											echo "<img src='logos/".$collab["logo"]."' width='144' height='108' class='image' alt='".$collab["name"]."' title='Nur angemeldete Nutzer können Collabs betrachten.' />";
										}
										echo "<span class='title'>".$collab["name"]."</span>";
										echo "<span class='owner'>".$collab["von"]."</span>";
										echo "</li>";
									}
								}
								else	{
									//Sorry, no active collabs
									echo "<div style='border: 10px #B6B7BA solid; height: 200px; width: 200px; border-radius: 125px;'><img style='margin: 6px 15px;' src='img/cat.png' alt='Cat' width='170' height='179' /></div>";
								}
							?>
						</ul>
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