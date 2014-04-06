<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		die(header("Location: index.php?error=nologin"));
	}
	
	$_PAGE -> setTitle(__("Account Settings"));
	$_PAGE -> setRobots(array("noindex", "nofollow"));
	$_PAGE -> useScript("jquery");
?>
<html>
	<head>
		<title><?php echo __("Account settings"); ?> &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/settings.css" />
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
								<h3><?php echo __("Account settings"); ?></h3>
							</div>
							<div class="box-content">
								<div class="inner">
									<h3><?php echo __("Language"); ?></h3>
									<form action="action.php?setlang" method="post">
										<p><?php echo __("Change the language of all static texts"); ?></p>
										<p>
											<?php echo __("Selected language:"); ?>
											<select name="language">
												<?php
													foreach($_LOCALE as $langcode => $langdata)	{
														if($_USER -> language == $langcode)	{
															$class = " selected";
														}
														else	{
															$class = "";
														}
														echo "<option" . $class . ">" . $langcode . "</option>";
													}
												?>
											</select>
										</p>
										<button class="button blue"><?php echo __("Save changes"); ?></button>
									</form>
									<!-- # -->
									<h3><?php echo __("E-Mail address"); ?></h3>
									<form action="action.php?setmail" method="post">
										<p><?php echo __("Here you can change your E-Mail address"); ?></p>
										<p><?php echo __("E-Mail address"); ?>: <input style="display: inline;" type="email" name="mail" value="<?php echo $_USER -> mail; ?>" /></p>
										<button class="button blue"><?php echo __("Save changes"); ?></button>
									</form>
									<!-- # -->
									<h3><?php echo __("Password"); ?></h3>
									<form action="action.php?setpass" method="post">
										<p><?php echo __("For your own safety, you should change your password frequently. Please don't use the same password as on Scratch"); ?></p>
										<input type="password" name="old" placeholder="<?php echo __("Old password"); ?>" required />
										<input type="password" name="new" placeholder="<?php echo __("New password"); ?>" required />
										<input type="password" name="new-2" placeholder="<?php echo __("Confirm new password"); ?>" required />
										<button class="button blue"><?php echo __("Save changes"); ?></button>
									</form>
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