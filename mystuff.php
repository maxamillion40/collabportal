<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online()) {
		$user = $_SESSION['user'];
		$mycollabs = mysql_get("SELECT * FROM collabs WHERE `owner`='$user' ORDER BY `start` DESC");
		$collabmember = mysql_get("SELECT * FROM collabs ORDER BY `start` DESC");
	}
	else {
		die(header("Location: index.php?error=nologin"));
	}
	mysql_close();
?>
<html>
	<head>
		<title>Meine Collabs &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/mystuff.css" />
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
								<h3>Meine Collabs</h3><span id='newcollab'><a href='new.php'><button class="button blue">+ Neues Collab</button></a></span>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										echo "<ul id='msu'>";
										echo "<h4>Eigner</h4>";
										if(count($mycollabs) > 0)	{
											//Collabliste
											echo "<div id='own'>";
											foreach($mycollabs as $collab)	{
												echo "<button class='button grey' onClick=\"navigate('admin.php?id=".$collab["id"]."');\">Verwaltung</button><li>";
												echo "<a href='collab.php?id=".$collab["id"]."'><img src='logos/".$collab["logo"]."' width='144' height='108' class='image' alt='".$collab["name"]."' /></a>";
												echo "<table class='stats'>";
													echo "<tr><th>Name:</th><td>".$collab["name"]."</td></tr>";
													echo "<tr><th>Status:</th><td>".$collab["status"]."</td></tr>";
													echo "<tr><th>Rang:</th><th>Eigner</th></tr>";
												echo "</td></tr></table></li>";
											}
											echo "</div>";
										}
										else	{
											//Keine Collabs
											echo "Du hast noch keine Collabs erstellt. <a href='new.php'>Gründe eins</a>!<hr/>";
										}
										echo "<h4>Mitglied</h4>";
										echo "<div id='member'>";
											$count = 0;
											foreach($collabmember as $collab)	{
												if(in_array($_SESSION["user"],$collab["mitglieder"]["people"]))	{
													echo "<button class='button grey' onClick=\"navigate('action.php?leave&red&id=".$collab["id"]."','Willst du wirklich aus dem Collab &bdquo;".$collab["name"]."&ldquo; austreten?')\">Austreten</button><li>";
													echo "<a href='collab.php?id=".$collab["id"]."'><img src='logos/".$collab["logo"]."' width='144' height='108' class='image' alt='".$collab["name"]."' /></a>";
													echo "<table class='stats'>";
														echo "<tr><th>Name:</th><td>".$collab["name"]."</td></tr>";
														echo "<tr><th>Status:</th><td>".$collab["status"]."</td></tr>";
														echo "<tr><th>Rang:</th><td>Mitglied</td></tr>";
														echo "<tr><th>Gründer:</th><td>".$collab["owner"]."</td></tr>";
													echo "</td></tr></table></li>";
													$count++;
												}
											}
										if($count == 0) {
											echo "Du hast noch an keinem Collab teilgenommen. <a href='./'>Nimm an einem teil</a>!<hr/>";
										}
										echo "</div></ul>";
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