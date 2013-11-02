<?php
	session_start();
	require_once("includes/func.php");
	mysql_auto_connect();
	$collab	= mysql_get("SELECT * FROM collabs WHERE `id`='".mysql_real_escape_string($_GET["id"])."'");
	$messages	= mysql_get("SELECT * FROM collabmessages WHERE `collab`='".mysql_real_escape_string($_GET["id"])."' ORDER BY `timestamp` DESC");
	mysql_close();
	if(count($collab) != 1)	{
		header("HTTP/1.0 404");
		header("Location: error404.php?error=nocollab");
	}
	$tage	= array();
		$tage["Monday"] = "Montag";
		$tage["Tuesday"] = "Dienstag";
		$tage["Wednesday"] = "Mittwoch";
		$tage["Thursday"] = "Donnerstag";
		$tage["Friday"] = "Freitag";
		$tage["Saturday"] = "Samstag";
		$tage["Sunday"] = "Sonntag";
		
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $collab[0]["name"]; ?> &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/collab.css" />
		<link rel="stylesheet" href="styles/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="styles/scratchblocks2.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/jqueryui/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="scripts/jquery/jquery.getUrlParam.js"></script>
		<script src="scripts/tinymce/tinymce.min.js"></script>
		<script src="scripts/scratchblocks2.js"></script>
		<script src="scripts/init.js"></script>
		<script src="scripts/livechat.php?id=<?php echo $_GET["id"]; ?>"></script>
		<script src="scripts/sbpopup.js"></script>
	</head>
	<body>
		<div id="dialogbox">Lorem Ipsum</div>
		<div id="pagewrapper">
			<!-- This is the blue box on the top of the site -->
				<?php
					include_once("includes/topnav.php");
				?>
			<!-- Main Content -->	
			<div class="container" id="content">
				<div class="cols clearfix">
					<div class="col-11">
						<article class="box collab">
							<div class="box-header">
								<h1><?php echo $collab[0]["name"]; ?></h1>
							</div>
							<div class="box-content" style="min-height: 150px;">
								<div class="inner">
									<?php
										if($collab[0]["logo"] != "none.png")	{
											echo "<img src='logos/".$collab[0]["logo"]."' alt='".$collab[0]["name"]." - Logo' width='144' height='108' style='float: left; margin: 5px;'  />";
										}
										echo "<p>".$collab[0]["desc"]."</p>";
									?>
								</div>
							</div>
						</article>
						<!-- Chat -->
						<article class="box">
							<div class="box-header">
								<h2><img src="img/chat.png" height="19" width="19" alt="Chat Icon" /> Live Chat</h2>
							</div>
							<div class="box-content">
								<div class="inner">
									<form action="action.php?chat&id=<?php echo $_GET["id"]; ?>" method="post" id="msgbox">
										<textarea name="msg"></textarea><br />
										<button type="submit">Senden</button>
										<span id="countdown-wrapper"><span id="chat-countdown"></span></span>
									</form>
								<div id="livechat">
									<div id="loading">
										<img src="img/loader.gif" alt="Loading chat..." />
										<p>Loading chat messages...</p>
									</div>
								</div>
								</div>
							</div>
						</article>
					</div>
					<div class="col-5">
						<!-- Basic Information -->
						<article class="box">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/info.png" alt="Info Icon" height="19" width="19" /> Info</h4>
							</div>
							<div class="box-content">
								<div class="inner">
										<table id="info">	
											<tr>
												<td class="collab-td">Start:</td>
												<td><?php echo $tage[date("l",$collab[0]["start"])]; echo date(", d.m.Y h:i",$collab[0]["start"]); ?></td>
											</tr>
											<tr>
												<td>Laufzeit:</td>
												<td><?php echo round((time()-$collab[0]["start"])/60/60/24); ?> Tag(e)</td>
											</tr>
											<tr>
												<td>Gründer:</td>
												<td><?php echo $collab[0]["mitglieder"]["founder"]; ?></td>
											</tr>
											<tr>
												<td>Status:</td>
												<td><?php 
													if($collab[0]["status"] == "open")	{
														echo "offen";
													}
													else	{
														echo "beendet";
													}
												?></td>
											</tr>
											<tr>
												<td>Rang:</td>
												<td><?php
														if(isset($_SESSION["user"]))	{
															if($collab[0]["mitglieder"]["founder"] == $_SESSION["user"])	{
																echo "Gründer";
															}
															elseif(in_array($_SESSION["user"],$collab[0]["mitglieder"]["people"]))	{
																echo "Mitglied";
															}
															elseif(in_array($_SESSION["user"],$collab[0]["mitglieder"]["candidates"]))	{
																echo "Anwärter";
															}
															else	{
																echo "Gast";
															}
														}
														else	{
															echo "Anonymer Gast";
														}
												?></td>
											</tr>
										</table>
								</div>
							</div>
						</article>
						<!-- Members -->
						<article class="box">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/people.png" alt="Mitglieder Icon" height="19" width="19" /> Mitglieder (<?php echo count($collab[0]["mitglieder"]["people"])+1; ?>)</h4>
							</div>
							<div class="box-content">
								<div class="inner box-no-padding">
										<ul id="members">
											<?php
												echo "<li class='founder member'> ".$collab[0]["mitglieder"]["founder"]."</li>";
												foreach($collab[0]["mitglieder"]["people"] as $mitglied)	{
													echo "<li class='member'>".$mitglied."</li>";
												}
											?>
										</ul>
								</div>
							</div>
						</article>
						<!-- Buttons -->
						<article class="box">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/actions.png" alt="Action Icon" height="19" width="19" /> Funktionen</h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										if(isset($_SESSION["user"]))	{
											if(in_array($_SESSION["user"],$collab[0]["mitglieder"]["people"]))	{
												//Buttons für normale Mitglieder
												echo "<button onClick=\"navigate('action.php?leave&id=".$_GET["id"]."','Willst du wirklich aus diesem Collab austreten?')\">Austreten</button>";
											}
											elseif($_SESSION["user"] == $collab[0]["mitglieder"]["founder"])	{
												//Buttons für Gründer
												echo "<button onClick=\"navigate('admin.php?id=".$_GET["id"]."');\">Verwaltung</button>";
											}
											elseif(in_array($_SESSION["user"],$collab[0]["mitglieder"]["candidates"]))	{
												echo "Dein Mitgliedsantrag ist in Bearbeitung.";
											}
											else	{
												//Buttons für Gäste
												if(count($collab[0]["mitglieder"]["people"]) + 1 < $collab[0]["settings"]["members_max"] or $collab[0]["settings"]["members_max"] == false and !in_array($_SESSION["user"],$collab[0]["mitglieder"]["candidates"]))	{
													echo "<button onClick=\"navigate('action.php?join&id=".$_GET["id"]."','Willst du diesem Collab beitreten? Tu dies nur, wenn du dir auch sicher bist, dass du mitmachen willst!');\">";
													if($collab[0]["settings"]["confirm_join"] == true)	{
														echo "Bewerben";
													}
													else	{
														echo "Beitreten";
													}
													echo "</button>";
												}
												else	{
													echo "Maximale Mitgliederzahl erreicht.";
												}
											}
										}
										else	{
											echo "<p>Diese Funktionen stehen nur Mitgliedern zur Verfügung.</p>";
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