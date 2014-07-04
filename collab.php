<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	$collab	= new collab($_GET["id"]);
	if(empty($collab -> name))	{
		header("HTTP/1.0 404");
		header("Location: error404.php?error=nocollab");
	}
	
	$_PAGE -> setTitle($collab -> name);
	$_PAGE -> setRobots(array("noindex", "nofollow"));
	$_PAGE -> useScript("jquery");
	$_PAGE -> useScript("tinymce");
	$_PAGE -> useScript("getUrlParam");
	$_PAGE -> useScript("scratchblocks");
	$_PAGE -> useScript("chat");
	
?>
<html>
	<head>
		<?php
			$_PAGE -> putHeader();
		?>
	</head>
	<body>
		<div id="dialogbox">&nbsp;</div>
		<div id="pagewrapper">
			<!-- This is the blue box on the top of the site -->
				<?php
					include_once("includes/topnav.php");
				?>
			<!-- "Back to top" -->
			<button class="button blue" id="backToTop"><?php echo __("Back to top"); ?></button>
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
										if($collab -> logo != "")	{
											$imgUrl = "data:image/png;base64," . base64_encode($collab -> logo);
											echo "<img src='" . $imgUrl . "' alt='".$collab -> name." - Logo' width='144' height='108' style='float: left; margin: 5px; border: 1px solid #DDDDDD' />";
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
									<div class="chatbox-form">
									<?php
										if($collab -> status != "closed")	{
									?>
									<form action="action.php?chat&id=<?php echo $_GET["id"]; ?>" method="post" id="msgbox">
										<textarea name="msg"></textarea><br />
										<button type="submit"><?php echo __("Send"); ?></button>
									</form>
									</div>
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
									<img id="loadimg" src="img/loader.gif" alt="Loading" />
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
						<article class="box">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;"><img src="img/player_flag2.png" alt="Info Icon" height="19" width="19" /> <?php echo __("Project preview"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner" style="padding: 0; padding-top: 15px;">
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
						<!-- Announcement -->
						<article class="box" id="box-announcements">
							<div class="box-header">
								<h4 style="font-size: 22px; margin-left: 15px; height: 26px; padding: 5px;">
									<img src="img/info.png" alt="Info Icon" height="19" width="19" />
									<?php echo __("Announcements"); ?>
									<img src="img/loader.gif" alt="Loader" height="19" width="19" class="boxLoader" />
								</h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										if($collab -> announcement != "")	{
											if($collab -> member_rank($_USER -> name) == "founder")	{
												echo "<p class=\"canEdit\">" . $collab -> announcement . "</p>";
											}
											else	{
												echo "<p>" . $collab -> announcement . "</p>";
											}
										}
										else	{
											if($collab -> member_rank($_USER -> name) == "founder")	{
												echo "<p class=\"canEdit\">" . __("Nothing here") . "</p>";
											}
											else	{
												echo "<p>" . __("Nothing here") . "</p>";
											}
										}
									?>
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
											if($collab -> status == "open")	{
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
												echo "<p>" . __("This collab is closed.") . "</p>";
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