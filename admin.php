<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		die(header("Location: index.php?error=nologin"));
	}

	$id = $_GET["id"];
	$collab = new collab($id);
	
	$_PAGE -> setTitle(__("Administration"));
	$_PAGE -> setRobots(array("noindex", "nofollow"));
	$_PAGE -> useScript("jquery");
	$_PAGE -> useScript("tinymce");
?>
<html>
	<head>
		<?php
			$_PAGE -> putHeader();
		?>
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
								<h3><?php echo __("Settings"); ?></h3><span class="box-header-button"><a href="collab.php?id=<?php echo $_GET["id"]; ?>"><button><?php echo __("Back to Collab"); ?></button></a></span>
							</div>
							<div class="box-content">
								<div class="inner">
									<form action="action.php?settings&id=<?php echo $collab -> id; ?>" method="post">
										<table border="1">
											<tr id="row-max-members">
												<td><input type="checkbox" id="check-max-members" name="check-max-members" <?php
													if($collab -> settings["members_max"] != 0)	{
														echo "checked='checked' ";
													}
												?> /></td>
												<td><?php echo __("Maximum number of members"); ?></td>
												<td><input type="number" min="<?php echo count($collab -> members["people"]) + 1; ?>" id="input-max-members" placeholder="Zahl" name="input-max-members" value="<?php echo $collab -> settings["members_max"]; ?>" /></td>
												<td><?php echo __("When this number is reached (including the founder), the Join-Button won't appear anymore so no other Scratcher can join."); ?></td>
											</tr>
											<tr id="row-confirm-join">
												<td><input type="checkbox" id="check-confirm-join" name="check-confirm-join" <?php
													if($collab -> settings["confirm_join"] == true)	{
														echo "checked='checked' ";
													}
												?>/></td>
												<td><?php echo __("Confirm join"); ?></td>
												<td>&nbsp;</td>
												<td><?php echo __("New members need to be confirmed by you, before they can actively contribute."); ?></td>
											</tr>
											<tr id="row-new-members">
												<td><input type="checkbox" id="check-new-members" name="check-new-members" <?php
													if($collab -> settings["new_members"] == true)	{
														echo "checked='checked' ";
													}
												?> /></td>
												<td><?php echo __("New members wanted"); ?></td>
												<td>&nbsp;</td>
												<td><?php echo __("When this is activated, your collab will be marked as \"searching for new members\""); ?></td>
											</tr>
											<tr id="row-language">
												<td>&nbsp;</td>
												<td><?php echo __("Language"); ?></td>
												<td>
													<select name="select-language">
														<?php
															foreach($_LOCALE as $langcode => $langdata)	{
																if($collab -> settings["language"] == $langcode)	{
																	$class = " selected";
																}
																else	{
																	$class = "";
																}
																echo "<option class=\"langSetting $langcode\"" . $class . ">" . $langcode . "</option>";
															}
														?>
													</select>
												</td>
												<td><?php echo __("Select a preferred language for the communication in your collab"); ?></td>
											</tr>
										</table>
										<button type="submit"><?php echo __("Save changes"); ?></button>
									</form>
								</div>
							</div>
						</article>
						<article class="box">
							<div class="box-head">
								<h4><?php echo __("Members"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner <?php if(count($collab -> members["people"]) > 0)	{ echo "box-no-padding"; } ?>">
									<ul class="members">
										<?php
											if(count($collab -> members["people"]) > 0)	{
												foreach($collab -> members["people"] as $member)	{
													echo "<li>".$member -> name ."<span class='li-right'><a href='messages.php?to=" . $member -> name ."#new'>" . __("Message") . "</a> <a class='red' href='action.php?kick=" . $member -> name . "&id=$id'>" . __("Kick") . "</a></span></li>";
												}
											}
											else	{
												echo __("It's a bit lonely in here...");
											}
										?>
									</ul>
								</div>
							</div>
						</article>
						<article class="box<?php if($collab -> settings["confirm_join"] == false) { echo " hidden"; } ?>">
							<div class="box-head">
								<h4><?php echo __("Candidates"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner <?php if(count($collab -> members["candidates"]) > 0)	{ echo "box-no-padding"; } ?>">
									<ul class="members">
										<?php
											if(count($collab -> members["candidates"]) > 0)	{
												foreach($collab -> members["candidates"] as $candidate)	{
													echo "<li>" . $candidate -> name . "<span class='li-right'><a class='green' href='action.php?accept&who=" . $candidate -> name . "&id=" . $_GET["id"] . "'>" . __("Accept") . "</a> <a href='messages.php?to=". $candidate -> name ."#new'>" . __("Message") . "</a> <a class='red' href='action.php?kick=" . $candidate -> name . "&id=$id'>" . __("Refuse") . "</a></span></li>";
												}
											}
											else	{
												echo __("Nobody has applied yet...");
											}
										?>
									</ul>
								</div>
							</div>
						</article>
						<article class="box">
							<div class="box-head">
								<h4><?php echo __("Edit Collab"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<form action="action.php?editcollab&id=<?php echo $collab -> id; ?>" method="post" enctype="multipart/form-data">
										<?php
											if($collab -> logo != "")	{
												echo "<img style='float: right;' src='" . "data:image/png;base64," . base64_encode($collab -> logo) . "' alt='Logo' width='144' height='108' />";
											}
										?>
										<p style="margin-bottom: 30px;"><?php echo __("Logo"); ?>: <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /><input type="file" name="logo" /></p>
										<input type="text" name="name" maxlength="50" value="<?php echo $collab -> name; ?>" placeholder="<?php echo __("Name of your Collab"); ?>" />
										<textarea name="desc"><?php
											echo $collab -> desc;
										?></textarea>
										<button class="button blue"><?php echo __("Save changes"); ?></button>
									</form>
								</div>
							</div>
						</article>
						<article class="box">
							<div class="box-head">
								<h4><?php echo __("Close collab"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										$time = time();
										if($time - $collab -> starttime -> stamp > 86400)	{
											echo "<form action='action.php?closecollab&id=". $collab -> id ."' method='post'>";
											echo "<p>" . __("Here you can close your collab, but please note the following") . ":</p>";
											echo "<ul>";
											echo "<li>" . __("Closed collabs cannot be opened again") . "</li>";
											echo "<li>" . __("The chat will become read-only") . "</li>";
											echo "<li>" . __("All members will receive a notification about the collab being closed") . "</li>";
											echo "<li>" . __("Your Collab won't appear on the homepage anymore") . "</li>";
											echo "</ul>";
											echo "<label><input type='checkbox' id='success' name='success' value='true' /> " . __("Yes, we could finish and publish our project") . "</label>";
											echo "<div id='enter-url'><input type='type' name='url' placeholder='" . __("Projectnumber") . "' /><textarea maxlength='100' name='desc' placeholder='" . __("Short description") . "'></textarea></div>";
											echo "<button type='submit' class='button blue'>" . __("Close this collab") . "</button>";
											echo "</form>";
										}
										else	{
											echo __("Collabs cannot be closed until they exist for 24 hours.");
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
	</body>
</html>