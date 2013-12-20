<?php
	require_once("includes/loader.php");
	$collab	= new collab($_GET["id"]);
	if($_USER -> is_online())	{
		$messages	= $_MYSQL -> get("SELECT * FROM collabmessages WHERE `collab`='".$_GET["id"]."' ORDER BY `timestamp` DESC");
	}
	if(empty($collab -> name))	{
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
		<title><?php echo $collab -> name; ?> &raquo; ScratchCollabs in DACH</title>
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
		<script src="scripts/jquery.visible.min.js"></script>
		<script src="scripts/jquery.visibility.js"></script>
		<script src="scripts/tinymce/tinymce.min.js"></script>
		<script src="scripts/scratchblocks2.js"></script>
		<script src="scripts/init.js"></script>
		<script src="scripts/livechat.php?id=<?php echo $_GET["id"]; ?>"></script>
		<script src="scripts/sbpopup.js"></script>
	</head>
	<body>
		<div id="dialogbox">&nbsp;</div>
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
								<h1><?php echo $collab -> name; ?></h1>
							</div>
							<div class="box-content" style="min-height: 150px;">
								<div class="inner">
									<?php
										if($collab -> logo != "none.png")	{
											echo "<img src='logos/".$collab -> logo."' alt='".$collab -> name." - Logo' width='144' height='108' style='float: left; margin: 5px; border: 1px solid #DDDDDD' />";
										}
										echo "<p>" . $collab -> desc . "</p>";
									?>
								</div>
							</div>
						</article>
						<!-- Chat -->
						<article class="box">
							<div class="box-header">
								<h2><img src="img/chat.png" height="19" width="19" alt="Chat Icon" /> <?php echo __("Live Chat"); ?></h2>
							</div>
							<div class="box-content">
								<div class="inner">
									<form action="action.php?chat&id=<?php echo $_GET["id"]; ?>" method="post" id="msgbox">
										<textarea name="msg"></textarea><br />
										<button type="submit">Senden</button>
										<!-- <span id="countdown-wrapper"><span id="chat-countdown"></span></span> -->
									</form>
								<div id="livechat">
									<div id="loading">
										<img src="img/loader.gif" alt="Loading chat..." />
										<p><?php echo __("Loading chat messages"); ?>...</p>
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
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/info.png" alt="Info Icon" height="19" width="19" /> <?php echo __("Info"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner">
										<table id="info">	
											<tr>
												<td class="collab-td"><?php echo __("Start"); ?>:</td>
												<td><?php echo __(date("l",$collab -> starttime)); echo date(", d.m.Y h:i",$collab -> starttime); ?></td>
											</tr>
											<tr>
												<td><?php echo __("Runtime"); ?>:</td>
												<td><?php echo round((time() - $collab -> starttime)/60/60/24); ?> Tag(e)</td>
											</tr>
											<tr>
												<td><?php echo __("Founder"); ?>:</td>
												<td><?php echo $collab -> owner -> name; ?></td>
											</tr>
											<tr>
												<td><?php echo __("Status"); ?>:</td>
												<td><?php 
													echo $collab -> status;
												?></td>
											</tr>
											<tr>
												<td><?php echo __("Rank"); ?>:</td>
												<td><?php
														echo $collab -> member_rank($_USER -> name);
												?></td>
											</tr>
										</table>
								</div>
							</div>
						</article>
						<!-- Members -->
						<article class="box">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/people.png" alt="Members Icon" height="19" width="19" /> <?php echo __("Members"); ?> (<?php echo count($collab -> members["people"])+1; ?>)</h4>
							</div>
							<div class="box-content">
								<div class="inner box-no-padding">
										<ul id="members">
											<?php
												echo "<li class='founder member'> ".$collab -> owner -> name."</li>";
												foreach($collab -> members["people"] as $mitglied)	{
													echo "<li class='member'>" . $mitglied -> name . "</li>";
												}
											?>
										</ul>
								</div>
							</div>
						</article>
						<!-- Buttons -->
						<article class="box">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/actions.png" alt="Action Icon" height="19" width="19" /> <?php echo __("Actions"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										if($_USER -> is_online())	{
											if(array_key_exists($_USER -> name, $collab -> members["people"]))	{
												//Buttons für normale Mitglieder
												echo "<button onClick=\"navigate('action.php?leave&id=".$_GET["id"]."','Willst du wirklich aus diesem Collab austreten?')\">Austreten</button>";
											}
											elseif($_USER -> name == $collab -> owner -> name)	{
												//Buttons für Gründer
												echo "<button onClick=\"navigate('admin.php?id=".$_GET["id"]."');\">Verwaltung</button>";
											}
											elseif(array_key_exists($_USER -> name, $collab -> members["candidates"]))	{
												echo "Dein Mitgliedsantrag ist in Bearbeitung.";
											}
											else	{
												//Buttons für Gäste
												if(count($collab -> members["people"]) + 1 < $collab -> settings["members_max"] or $collab -> settings["members_max"] == false and !array_key_exists($_USER -> name,$collab-> members["candidates"]))	{
													echo "<button onClick=\"navigate('action.php?join&id=".$_GET["id"]."','Willst du diesem Collab beitreten? Tu dies nur, wenn du dir auch sicher bist, dass du mitmachen willst!');\">";
													if($collab -> settings["confirm_join"] == true)	{
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