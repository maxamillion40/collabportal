<?php
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	$collab = mysql_get("SELECT * FROM `collabs` WHERE `id`=" . $_GET["id"]);
	$collab[0]["settings"] = unserialize($collab[0]["settings"]);
	$collab[0]["mitglieder"] = unserialize($collab[0]["mitglieder"]);
	$id = $_GET["id"];
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
		<link rel="stylesheet" href="styles/admin.css" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/init.js"></script>
		<script src="scripts/admin.js"></script>
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
								<h4>Einstellungen</h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<form action="action.php?settings&id=<?php echo $collab[0]["id"]; ?>" method="post">
										<table border="1">
											<tr id="row-max-members">
												<td><input type="checkbox" id="check-max-members" name="check-max-members" <?php
													if(gettype($collab[0]["settings"]["members_max"]) != "boolean")	{
														echo "checked='checked' ";
													}
												?> /></td>
												<td>Maximale Mitgliederzahl</td>
												<td><input type="number" id="input-max-members" placeholder="Zahl" name="input-max-members" value="<?php echo $collab[0]["settings"]["members_max"]; ?>" /></td>
												<td>Wenn dieses Limit erreicht ist, wird der Button zum Beitritt nicht mehr angezeigt, sodass kein weiterer Scratcher beitreten kann.</td>
											</tr>
											<tr id="row-confirm-join">
												<td><input type="checkbox" id="check-confirm-join" name="check-confirm-join" <?php
													if($collab[0]["settings"]["confirm_join"] == true)	{
														echo "checked='checked' ";
													}
												?>/></td>
												<td>Beitritt bestätigen</td>
												<td>&nbsp;</td>
												<td>Neue Mitglieder müssen zunächst von dir freigeschaltet werden, bevor sie aktiv teilnehmen können.</td>
											</tr>
										</table>
										<button type="submit">Änderungen speichern</button>
									</form>
								</div>
							</div>
						</article>
						<article class="box ">
							<div class="box-head">
								<h4>Mitglieder</h4>
							</div>
							<div class="box-content">
								<div class="inner box-no-padding">
									<ul id="members">
										<?php
											foreach($collab[0]["mitglieder"]["people"] as $member)	{
												echo "<li>".$member."<span class='li-right'><a>Nachricht</a> <a class='red' href='action.php?kick=$member&id=$id'>Kicken</a></span></li>";
											}
										?>
									</ul>
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