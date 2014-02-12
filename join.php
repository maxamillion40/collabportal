<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if($_USER -> is_online())	{
		header("Location: index.php");
	}
?>
<html>
	<head>
		<title><?php echo __("Sign up"); ?> &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="index,follow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
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
				<article class="box">
					<div class="box-head">
						<h4><?php echo __("Sign up"); ?></h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<p>
								<?php 
									echo __("Registration on Scratchcolabs is free and we won't tell anyone your private data. Please note that this is not an official project of the Scratch Team.");
									echo __("Make sure not to forget your password! Once you set it, we won't be able to tell it to you!");
								?>
							</p>
							<form action="action.php?signup" method="post">
								<input value="<?php if(isset($_GET["name"])) {echo $_GET["name"];} ?>" type="text" name="name" placeholder="<?php echo __("Desired username"); ?>" required autocomplete="off" title="Mit welchem Namen möchtest du dich hier anmelden und mit anderen Scratchern schreiben?" autofocus tabindex="1" />
								<input value="<?php if(isset($_GET["email"])) {echo $_GET["email"];} ?>" type="email" name="email" placeholder="<?php echo __("Your Email address"); ?>" required autocomplete="off" title="Deine Email Adresse brauchen wir nur, um Mehrfachanmeldungen zu verhindern." tabindex="2" />
								<input value="<?php if(isset($_GET["scratch"])) {echo $_GET["scratch"];} ?>" type="text" name="scratch" placeholder="<?php echo __("Your Scratch account"); ?>" required autocomplete="off" title="Wie lautet dein Nutzername auf Scratch?" tabindex="3" />
								<input type="password" name="pass" placeholder="<?php echo __("Password"); ?>"  required autocomplete="off" title="<?php echo __("Don't use the same password as on Scratch"); ?>" tabindex="4" />
								<input type="password" name="pass_check" placeholder="<?php echo __("Confirm password"); ?>" required autocomplete="off" title="<?php echo __("Please confirm your password"); ?>" tabindex="5" />
								<label><input type="checkbox" name="rules" value="accept" required title="Wirklich?" tabindex="6" /> <?php echo __("Yes, I read the terms of use and accept them"); ?></label>
								<input type="submit" class="button grey" value="<?php echo __("Sign up"); ?>" tabindex="7" />
							</form>
						</div>
					</div>
				</article>
			</div>
			<!-- Footer -->
			<?php
				include_once("includes/footer.php");
			?>
		</div>
	</body>
</html>