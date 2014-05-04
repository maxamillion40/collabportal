<?php
	//DEAD FILE//
	exit;
?>
<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		header("Location: index.php");
	}
	
	$_PAGE -> setTitle(__("New private message"));
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
				<article class="box" id="new">
					<div class="box-head">
						<h4><?php echo __("New message"); ?></h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<form action="action.php?sendmessage" method="post">
								<input type="text" name="sendto" placeholder="<?php echo __("Recipient"); ?>" required onBlur="javascript: divide_sendto();" value="<?php if(isset($_GET["to"])) { echo $_GET["to"] . ";"; } ?>" />
								<input type="text" name="regard" placeholder="<?php echo __("Regard"); ?>" value="<?php if(isset($_GET["regard"])) { echo $_GET["regard"]; } ?>" />
								<textarea name="msg"></textarea>
								<input type="submit" value="<?php echo __("Send"); ?>" class="button grey" />
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