<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	
	$_PAGE -> setTitle(__("The team"));
	$_PAGE -> setRobots(array("index", "follow"));
	$_PAGE -> useScript("jquery");
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
				<!-- div für obere boxen -->
				<div class="cols clearfix" style="top: -10px; padding-left: 10px; padding-right: 10px;">
					<!-- Liste -->	
						<article class="box ">
							<div class="box-head">
								<h3><?php echo __("The team"); ?></h3>
							</div>
							<div class="box-content">
								<div class="inner">
									<h3><?php echo __("Admins"); ?></h3>
										<img src="http://cdn.scratch.mit.edu/get_image/user/909333_75x75.png?v=1367988496.15" width="75px" /><div class="desc"><h4>webdesigner97</h4>
										<p><?php echo __("webdesigner97 is the founder and main admin of ScratchHub. His jobs during development (like database administration, planning new features, organising stuff and working on the core) are quite basic, but indispensable. Feel free to contact him if you have any problems, questions or criticism."); ?></p></div>
										<img src="http://cdn.scratch.mit.edu/get_image/user/1900672_75x75.png?v=1380467242.62" width="75px" /><div class="desc"><h4>Lirex</h4>
										<p><?php echo __("Having watched the development of ScratchHub (formerly known as Collabportal), Lirex joined the team on August 8, 2012. His main conributions consist of texts, graphics, design and FAQ work. Additionally, he moderates ScratchHub and can be contacted if you have problems."); ?></p></div>
									<h3><?php echo __("Moderators"); ?></h3>
									<h3><?php echo __("Testers"); ?></h3>
										<div class="t-block">T<div class="rotate"><?php echo __("Testers"); ?></div></div><div class="desc"><h4>akhof</h4>
										<p><?php echo __("Akhof was the first external tester of ScratchHub."); ?></p></div>
									<h3><?php echo __("Beta testers"); ?></h3>
										<ul class="desc">
											<li>Ominöse Person</li>
										</ul>
									<h3><?php echo __("Special thanks to:"); ?></h3>
										<ul class="desc">
											<li><?php echo __("LiFaytheGoblin (Old logo, mentor, lots of ideas)"); ?></li>
											<li><?php echo __("Scratch Team (Allowing the use the Scratch 2.0 design)"); ?></li>
											<li><a href="http://icondrawer.com" target="_blank">icondrawer.com</a> <?php echo __("for country flags"); ?></li>
										</ul>
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