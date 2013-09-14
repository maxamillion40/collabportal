<?php
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	$collab = mysql_get("SELECT * FROM `collabs` WHERE `id`=" . $_GET["id"]);
	$collab[0]["settings"] = unserialize($collab[0]["settings"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Über &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/about.css" />
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
								<h4>Collabverwaltung</h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										print_array($collab);
									?>
									<table>
										<tr>
											<td>Maximale Mitgliederzahl:</td>
											<td><?php
												if(!is_int($collab[0]["settings"]["members_max"]))	{
													echo "Nicht definiert";
												}
												else	{
													echo $collab[0]["settings"]["members_max"];
												}
											?></td>
										</tr>
									</table>
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