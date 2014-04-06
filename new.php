<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		header("Location: index.php?error=nologin");
	}
	
	$_PAGE -> setTitle(__("New Collab"));
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