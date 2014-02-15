<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		header("Location: index.php?error=nologin");
	}
?>
<html>
	<head>
		<title><?php echo __("new collab"); ?> &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/tinymce/tinymce.min.js"></script>
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
					<div class="box-header">
						<h2><?php echo __("Create a new collab"); ?></h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<form action="action.php?new" method="post">
								<!-- First step -->
								<h3><?php echo __("Step 1: Name"); ?></h3>
								<div>
									<p><?php echo __("Imagine a unique name for your collab"); ?><p>
									<input type="text" name="collabname" placeholder="<?php echo __("Collabname"); ?>" required maxlength="40" />
								</div>
								<!-- Second step -->
								<h3><?php echo __("Step 2: Description"); ?></h3>
								<div>
									<p><?php echo __("Describe your collab as detailed as possible. Also name the goals."); ?></p>
										<textarea name="desc"></textarea>
								</div>
								<!-- Third step -->
								<h3><?php echo __("Step  3: Settings"); ?></h3>
								<div>
									<p><?php echo __("Having published your collab, you can do more settings in the <em>Administration</em>"); ?></p>
								</div>
								<button type="submit" class="button blue"><?php echo __("Start this collab"); ?></button>
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