<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		header("Location: index.php");
	}
	$msg = $_GET["id"];
	$msg = explode("-",$msg);
	$msg = $msg[1];
	$msg = new message($msg);
	if($msg -> to -> name != $_USER -> name)	{
		header("Location: messages.php?error=nopriv");
	}
	if(!$msg -> read)	{
		$_MYSQL -> set("UPDATE `messages` SET `read`='1' WHERE `id`=?", array($msg -> id));
	}
	
	$_PAGE -> setTitle(__("Private message"));
	$_PAGE -> setRobots(array("noindex", "nofollow"));
	$_PAGE -> useScript("jquery");
	$_PAGE -> useScript("scratchblocks");
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
								<h3><?php echo $msg -> regard; ?></h3>
								<span class="box-header-button">
									<?php
										if($msg -> sender -> name != "System")	{
											echo "<a href='messages.php?to=" . $msg -> sender -> name."&regard=Re: " . $msg -> regard . "#new'><button class='button blue'>" . __("Reply") . "</button></a>";
										}
									?>
									<a href="action.php?delete&id=<?php echo $msg -> id; ?>"><button class="button grey"><?php echo __("Delete"); ?></button></a>
								</span>
							</div>
							<div class="box-content">
								<div class="inner box-no-padding">
									<div id="msg-head">
										<p><?php echo $msg -> sender -> name; ?> am <?php $msg -> date -> printas("d.m.Y \u\m H:i"); ?></p>
									</div>
									<div id="msg-body">
										<?php
											echo $msg -> msg;
										?>
									</div>
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