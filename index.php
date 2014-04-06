<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	
	$featured = $_MYSQL -> get("SELECT * FROM featured_collab ORDER BY id DESC LIMIT 1");
	
	$news = $_MYSQL -> get("SELECT * FROM news ORDER BY date DESC LIMIT 0,3");
	
	$collabs = $_MYSQL -> get("SELECT id FROM collabs WHERE `status`='open' ORDER BY id DESC");
	foreach($collabs as $key => $collab)	{
		$collabs[$key] = new collab($collab["id"]);
	}
	
	//Filter
	
	$ncollabs = 0;
	$acollabs = 0;
	foreach($collabs as $collab) {
		if($collab -> settings["new_members"] == true) {
			$ncollabs++;
		}
	}
	foreach($collabs as $collab) {
		if($collab -> settings["new_members"] == false) {
			$acollabs++;
		}
	}
	
	$_PAGE -> setTitle(__("Home"));
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
				<div class="cols" style="top: -10px;">
					<!-- 1. Box -->
					<div class="col-9">	
						<article style="max-height: 315px;" class="box">
							<div class="box-head">
								<h4><?php echo __("Featured Collab"); ?></h4>
								<a class="right" id="help"><span>?</span></a>
							</div>
							<div class="box-content" style="height: 279px;">
								<div class="inner">
									<?php
										if(count($featured) > 0)	{
											echo "<table id='featured-collab'>";
											echo "<tr>";
											echo "<td>";
											echo "<a href='".$featured[0]["url"]."'><img class='image' src='".$featured[0]["img"]."' alt='".$featured[0]["name"]."' height='180' width='240' /></a>";
											echo "</td>";
											echo "<td>";
											echo "<a href='".$featured[0]["url"]."' id='featured-h'>".$featured[0]["name"]."</a>";
											echo "<div id='featured-desc'><p>".$featured[0]["desc"]."</p></div>";
											echo "</td>";
											echo "</tr>";
											echo "<tr>";
											echo "<td colspan='2'>";
											echo "<p><b>Mitglieder: </b>".$featured[0]["mitglieder"]."</p>";
											echo "</td>";
											echo "</tr>";
											echo "</table>";
										}
									?>
								</div>
							</div>
						</article>
					</div>
					<!-- 2. Box -->
					<div class="col-7">	
						<article style="max-height: 315px;" class="box">
							<div class="box-head">
								<h4><?php echo __("News"); ?></h4>
							</div>
							<div class="box-content" style="height: 279px;">
								<div class="inner box-no-padding">
									<div id="news-feed">
										<ul class="event-list">
											<?php
												foreach($news as $entry)	{
													echo "<li>";
													echo "<img class='event-img' src='img/".$entry["pic"]."' alt='News' width='50' height='50' />";
													echo "<div class='msg-content'>";
													echo "<p class='event-headline'>".$entry["headline"]."</p>";
													echo "<p class='event-msg'>".$entry["msg"]."</p>";
													echo "</div>";
													echo "</li>";
												}
											?>
										</ul>
									</div>
								</div>
							</div>
						</article>
					</div>
				</div>
			<article class="box" >
				<div class="box-head">
					<h3><?php echo __("New members wanted"); ?> (<?php echo $ncollabs; ?>)</h3>
				</div>
				<div class="box-content slider-carousel">
					<div class="viewport">
						<ul style="width: 100%; overflow: hidden; left: 0px;">
							<?php
								if($ncollabs > 0)	{
									foreach($collabs as $collab)	{
									if($collab -> settings["new_members"] == true) {
										echo "<li class='project thumb item'>";
										echo "<a href='collab.php?id=".$collab->id."'><img src='logos/".$collab->logo."' width='144' height='108' class='image' alt='".$collab->name."' /></a>";
										echo "<span class='title'><span class='label n'>N</span><span class='label a'>A</span>".$collab->name."</span>";
										echo "<span class='owner'>".$collab->owner->name."</span>";
										echo "</li>";
									}
									}
								}
								else	{
									//Sorry, no active collabs
									echo "<div style='border: 10px #B6B7BA solid; height: 200px; width: 200px; border-radius: 125px;'><img style='margin: 6px 15px;' src='img/cat.png' alt='Cat' width='170' height='179' /></div>";
								}
							?>
						</ul>
					</div>
				</div>
			</article>
			<article class="box" >
				<div class="box-head">
					<h3><?php echo __("Active Collabs"); ?> (<?php echo $acollabs; ?>)</h3>
				</div>
				<div class="box-content slider-carousel">
					<div class="viewport">
						<ul style="width: 100%; overflow: hidden; left: 0px;">
							<?php
								if($acollabs > 0)	{
									foreach($collabs as $collab)	{
										echo "<li class='project thumb item'>";
										echo "<a href='collab.php?id=".$collab->id."'><img src='logos/".$collab->logo."' width='144' height='108' class='image' alt='".$collab->name."' /></a>";
										echo "<span class='labels' style='height: 18px;'>";
										if($collab -> settings["new_members"] == true) {
											echo "<span class='label n'>N</span>";
										}
										echo "<span class='label a'>A</span><span class='label c'>C</span><span class='label f'>F</span></span>";
										echo "<span class='title'>".$collab->name."</span>";
										echo "<span class='owner'>".$collab->owner->name."</span>";
										echo "</li>";
									}
								}
								else	{
									//Sorry, no active collabs
									echo "<div style='border: 10px #B6B7BA solid; height: 200px; width: 200px; border-radius: 125px;'><img style='margin: 6px 15px;' src='img/cat.png' alt='Cat' width='170' height='179' /></div>";
								}
							?>
						</ul>
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