<!DOCTYPE html>
<?php
	header("HTTP/1.1 403 Forbidden");
	require_once("includes/loader.php");
	
	$url = "http://" . $_SERVER["SERVER_NAME"] . "/collabs2";
?>
<html>
	<head>
		<title><?php echo __("One way"); ?>  &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="<?php echo $url; ?>/styles/main.css" />
		<link rel="stylesheet" href="<?php echo $url; ?>/styles/cp.css" />
		<link rel="stylesheet" href="<?php echo $url; ?>/styles/error404.css" />
		<link rel="stylesheet" href="<?php echo $url; ?>/styles/scratchblocks2.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo $url; ?>/favicon.ico" />
		<!-- Scripts -->
		<script src="<?php echo $url; ?>/scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="<?php echo $url; ?>/scripts/init.js"></script>
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
						<h4><?php echo __("Nothing to see..."); ?></h4>
					</div>
					<div class="box-content" id="box-404">
						<div class="inner">
							<p class="centered"><?php echo __("Hmm, you aren't supposed to see this page."); ?></p>
							<p class="centered"><?php echo __("How did you get here?"); ?></p>
							<div id="box404">
								<div class="blocks scratchblocks2-container">
									<div class="script">
										<div class="cwrap control cap">
											<div class="stack control cstart"><?php echo __("If"); ?> <div class="boolean operators"><?php echo __("not"); ?> <div class="boolean sensing"><?php echo __("user"); ?> <div class="dropdown"><?php if(is_loggedin()) { echo $_SESSION["user"]; } else { echo __("Anonymous"); } ?></div> <?php echo __("has access"); ?></div></div></div>
											<div class="cmouth">
												<div class="stack sensing"><?php echo __("Ask"); ?> <div class="string"><?php echo __("Why are you here?"); ?></div> <?php echo __("and wait"); ?></div></a>
												<div class="stack motion" style="cursor:pointer;" onClick="navigate('<?php echo $url; ?>/index.php');"><?php echo __("Back to the homepage"); ?></div><div class="comment attached"><div><?php echo __("Click me"); ?></div></div>
											</div>
											<div class="stack cend control"></div>
										</div>
									</div>
								</div>
							</div>
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