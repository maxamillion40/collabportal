<?php
	session_start();
	require_once("includes/func.php");
	if(!is_loggedin())	{
		die(header("Location: index.php?error=nologin"));
	}
		if(!isset($_GET["id"])) {
		die(header("Location: mystuff.php?error=nocollab"));
	}
	mysql_auto_connect();
	$collab = mysql_get("SELECT * FROM `collabs` WHERE `id`=" . $_GET["id"]);
	$id = $_GET["id"];
	if(count($collab) !=1 or $collab[0]["mitglieder"]["founder"] != $_SESSION["user"])	{
		die(header("Location: mystuff.php?error=notmine"));
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Verwaltung &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/admin.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/tinymce/tinymce.min.js"></script>
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
						<article class="box">
							<div class="box-head">
								<h3>Einstellungen</h3><span class="box-header-button"><a href="collab.php?id=<?php echo $_GET["id"]; ?>"><button>Zum Collab</button></a></span>
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
												<td><input type="number" min="1" id="input-max-members" placeholder="Zahl" name="input-max-members" value="<?php echo $collab[0]["settings"]["members_max"]; ?>" /></td>
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
						<article class="box">
							<div class="box-head">
								<h4>Mitglieder</h4>
							</div>
							<div class="box-content">
								<div class="inner <?php if(count($collab[0]["mitglieder"]["people"]) > 0)	{ echo "box-no-padding"; } ?>">
									<ul class="members">
										<?php
											if(count($collab[0]["mitglieder"]["people"]) > 0)	{
												foreach($collab[0]["mitglieder"]["people"] as $member)	{
													echo "<li>".$member."<span class='li-right'><a href='messages.php?to=$member#new'>Nachricht</a> <a class='red' href='action.php?kick=$member&id=$id'>Kicken</a></span></li>";
												}
											}
											else	{
												echo "Noch bist du allein...";
											}
										?>
									</ul>
								</div>
							</div>
						</article>
						<article class="box<?php if($collab[0]["settings"]["confirm_join"] == false) { echo " hidden"; } ?>">
							<div class="box-head">
								<h4>Anwärter</h4>
							</div>
							<div class="box-content">
								<div class="inner <?php if(count($collab[0]["mitglieder"]["candidates"]) > 0)	{ echo "box-no-padding"; } ?>">
									<ul class="members">
										<?php
											if(count($collab[0]["mitglieder"]["candidates"]) > 0)	{
												foreach($collab[0]["mitglieder"]["candidates"] as $candidate)	{
													echo "<li>".$candidate."<span class='li-right'><a class='green' href='action.php?accept&who=$candidate&id=".$_GET["id"]."'>Aufnehmen</a> <a href='messages.php?to=$candidate#new'>Nachricht</a> <a class='red' href='action.php?kick=$candidate&id=$id'>Zurückweisen</a></span></li>";
												}
											}
											else	{
												echo "Es hat sich noch niemand beworben...";
											}
										?>
									</ul>
								</div>
							</div>
						</article>
						<article class="box">
							<div class="box-head">
								<h4>Collab bearbeiten</h4>
							</div>
							<div class="box-content">
								<div class="inner <?php if(count($collab[0]["mitglieder"]["candidates"]) > 0)	{ echo "box-no-padding"; } ?>">
									<form action="action.php?editcollab&id=<?php echo $collab[0]["id"] ?>" method="post" enctype="multipart/form-data">
										<?php
											if($collab[0]["logo"] != "none.png")	{
												echo "<img style='float: right;' src='logos/".$collab[0]["logo"]."' alt='Logo' width='144' height='108' />";
											}
										?>
										<p style="margin-bottom: 30px;">Logo: <input type="hidden" name="MAX_FILE_SIZE" value="100000" /><input type="file" name="logo" /></p>
										<input type="text" name="name" maxlength="50" value="<?php echo $collab[0]["name"]; ?>" placeholder="Name des Collabs" />
										<textarea name="desc"><?php
											echo $collab[0]["desc"];
										?></textarea>
										<button class="button blue">Speichern</button>
									</form>
								</div>
							</div>
						</article>
						<article class="box">
							<div class="box-head">
								<h4>Collab beenden</h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										$time = time();
										if($time - $collab[0]["start"] > 86400)	{
											echo "<form action='action.php?closecollab&id=".$collab[0]["id"]."' method='post'>";
											echo "<p>Hier kannst du dein Collab beenden. Bitte beachte dabei ein paar grundlegende Dinge:</p>";
											echo "<ul>";
											echo "<li>Beendete Collabs können <u>nicht</u> wieder geöffnet werden</li>";
											echo "<li>Im Chat können keine weiteren Nachrichten mehr ausgetauscht werden</li>";
											echo "<li>Alle Mitglieder erhalten eine Nachricht, die sie über die Beendung benachrichtigt</li>";
											echo "<li>Dein Collab wird nicht mehr als aktiv auf der Startseite angezeigt</li>";
											echo "</ul>";
											echo "<label><input type='checkbox' id='success' name='success' value='true' /> Wir konnten unser Projekt erfolgreich beenden</label>";
											echo "<div id='enter-url'><input type='type' name='url' placeholder='Projektnummer' /><textarea maxlength='100' name='desc' placeholder='Kurzbeschreibung'></textarea></div>";
											echo "<button type='submit' class='button blue'>Collab beenden</button>";
											echo "</form>";
										}
										else	{
											echo "Du kannst dein Collab erst 24 Stunden nach dessen Start beenden.";
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