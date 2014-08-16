<!DOCTYPE html>
<?php
	header("HTTP/1.1 404 Not Found");
	require_once("includes/loader.php");
	
	$url = "http://" . $_SERVER["SERVER_NAME"];
?>
<html>
	<head>
		<title><?php echo __("Got lost?"); ?>  &raquo; ScratchCollabs in DACH</title>
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
						<h4><?php echo __("Route 404 - Took a wrong turn?"); ?></h4>
					</div>
					<div class="box-content" id="box-404">
						<div class="inner">
							<p class="centered"><?php echo __("We did our best, but this oage doesn't seem to exist"); ?></p>
							<p class="centered"><?php echo __("Maybe you used a veeeeery old link?"); ?></p>
							<div id="box404">
								<div class="blocks scratchblocks2-container">
									<div class="script">
										<div class="cwrap control cap">
											<div class="stack control cstart"><?php echo __("If"); ?> <div class="boolean operators"><div class="boolean obsolete"><?php echo __("Page not found"); ?></div> <?php echo __("and"); ?> <div class="boolean operators"><?php echo __("not"); ?> <div class="boolean sensing"><?php echo __("mistyped"); ?></div></div></div></div>
											<div class="cmouth">
												<div class="stack motion" style="cursor:pointer;" onClick="history.back();"><?php echo __("Back to last page"); ?></div></a><div class="comment attached"><div><?php echo __("Click me"); ?></div></div>
												<div class="stack motion" style="cursor:pointer;" onClick="navigate('<?php echo $url; ?>/index.php');"><?php echo __("Back to homepage"); ?></div>
												<div class="stack motion" style="cursor:pointer;" onClick="navigate('http://scratch.mit.edu');"><?php echo __("Scratch on!"); ?></div>
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