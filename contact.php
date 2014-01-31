<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
?>
<html>
	<head>
		<title><?php echo __("Contact"); ?> &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/contact.css" />
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
								<h3><?php echo __("Contact"); ?></h3>
							</div>
							<div class="box-content">
								<div class="inner">
									<p><h4><?php echo __("Use this form to contact us:"); ?></h4></p>
									<form id="contact" action="./">
										<?php
											if(!$_USER -> is_online()) {
												echo "<p>" . __("Please tell us your E-Mail address, so we can reply:") . "</p>";
												echo "<input type='email' name='email' placeholder='" . __("E-Mail address") . "' required />";
											}
										?>
										<p><?php echo __("Please select a category to speed up procession of your inquiry:"); ?></p>
										<select name="category">
											<option>-</option>
											<option><?php echo __("Bugs/Problems"); ?></option>
											<option><?php echo __("Question"); ?></option>
											<option><?php echo __("Ideas/Feedback"); ?></option>
											<option><?php echo __("Other"); ?></option>
										</select><br/>
										<p><?php echo __("Write your message here:"); ?>.</p>
										<textarea width="500px" height="250px" id="msg-input" placeholder="<?php echo __("Message"); ?>" name="message" required></textarea>										
										<p><?php echo __("When you're done, click Send. Please note that it might take several days for us to reply."); ?></p>
										<input type="submit" class="button blue" value="<?php echo __("Send"); ?>" />
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