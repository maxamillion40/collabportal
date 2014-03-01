<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	$collab	= new collab($_GET["id"]);
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
		<link rel="stylesheet" href="styles/scratchblocks2.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/jquery/jquery.getUrlParam.js"></script>
		<script src="scripts/tinymce/tinymce.min.js"></script>
		<script src="scripts/tinymce/jquery.tinymce.min.js"></script>
		<script src="scripts/scratchblocks2.js"></script>
		<script src="scripts/init.js"></script>
		<script src="scripts/infinitescroll.js"></script>
		<script src="scripts/autoupdate.js"></script>
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
						<article class="box" id="chatbox">
							<div class="box-header">
								<h2><img src="img/chat.png" height="19" width="19" alt="Chat Icon" /> <?php echo __("Live Chat"); ?></h2>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										if($collab -> status != "closed")	{
									?>
									<form action="action.php?chat&id=<?php echo $_GET["id"]; ?>" method="post" id="msgbox">
										<textarea name="msg"></textarea><br />
										<button type="submit"><?php echo __("Send"); ?></button>
										<!-- <span id="countdown-wrapper"><span id="chat-countdown"></span></span> -->
									</form>
									<?php
										}
										else	{
									?>
									<p><?php echo __("Chat is in read-only mode"); ?></p>
									<?php
										}
									?>
								<div id="livechat">
									
								</div>
								<div id="loading">
									<img src="img/loader.gif" alt="Loading" />
									<p><?php echo __("Loading older messages..."); ?></p>
									<p><?php echo __("Doesn't load? Try this button:"); ?></p>
									<p><button id="loadMore"><?php echo __("Load more!"); ?></button></p>
								</div>
								</div>
							</div>
						</article>
					</div>
					<div class="col-5">
						<?php
							if($collab -> settings["new_members"] == true)	{
						?>
						<article class="box box-emphasis">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/people.png" alt="Info Icon" height="19" width="19" /> <?php echo __("Members wanted"); ?></h4>	
							</div>
							<div class="box-content">
								<div class="inner">
									<p><?php echo __("Good news! This collab is looking for new participants!"); ?></p>
								</div>
							</div>
						</article>
						<?php
							}
						?>
						<article class="box">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/player_flag2.png" alt="Info Icon" height="19" width="19" /> <?php echo __("Project preview"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner">
								<?php
									if($collab -> pid != "")	{
								?>
								<iframe allowtransparency="true" width="278" height="230" src="http://scratch.mit.edu/projects/embed/<?php echo $collab -> pid; ?>/?autostart=false" allowfullscreen></iframe>
								<?php
									}
									else	{
										echo __("Nothing here");
									}
								?>
								</div>
							</div>
						</article>
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
												<td><?php echo __($collab -> starttime -> format("l")); $collab -> starttime -> printas(", d.m.Y h:i"); ?></td>
											</tr>
											<tr>
												<td><?php echo __("Runtime"); ?>:</td>
												<td><?php echo round((time() - $collab -> starttime -> stamp)/60/60/24); ?> Tag(e)</td>
											</tr>
											<tr>
												<td><?php echo __("Founder"); ?>:</td>
												<td><?php echo $collab -> owner -> name; ?></td>
											</tr>
											<tr>
												<td><?php echo __("Language"); ?>:</td>
												<td><?php echo $collab -> settings["language"]; ?></td>
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
						<!-- Announcement -->
						<article class="box">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/info.png" alt="Info Icon" height="19" width="19" /> <?php echo __("Announcements"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<p>
										<?php
											echo $collab -> announcement;
										?>
									</p>
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
												echo "<button onClick=\"navigate('action.php?leave&id=".$_GET["id"]."','" . __("Do you really want to leave this Collab?") . "')\">Austreten</button>";
											}
											elseif($_USER -> name == $collab -> owner -> name)	{
												//Buttons für Gründer
												echo "<button onClick=\"navigate('admin.php?id=".$_GET["id"]."');\">" . __("Administration") . "</button>";
											}
											elseif(array_key_exists($_USER -> name, $collab -> members["candidates"]))	{
												echo __("Your application is being processed");
											}
											else	{
												//Buttons für Gäste
												if(count($collab -> members["people"]) + 1 < $collab -> settings["members_max"] or $collab -> settings["members_max"] == false and !array_key_exists($_USER -> name,$collab-> members["candidates"]))	{
													echo "<button onClick=\"navigate('action.php?join&id=".$_GET["id"]."','" . __("Do you really want to join? Only do this if you are sure that you want to participate") . "');\">";
													if($collab -> settings["confirm_join"] == true)	{
														echo __("Apply");
													}
													else	{
														echo __("Join");
													}
													echo "</button>";
												}
												else	{
													echo __("Maximum number of members reached");
												}
											}
										}
										else	{
											echo "<p>" . __("These actions are only available for members") . "</p>";
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