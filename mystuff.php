<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if($_USER -> is_online()) {
		$mycollabs = $_MYSQL -> get("SELECT id FROM collabs WHERE `owner`=? ORDER BY `start` DESC", array($_USER -> name));
		$collabmember = $_MYSQL -> get("SELECT id FROM collabs ORDER BY `start` DESC");
		
		foreach($mycollabs as $key => $mycollab)	{
			$mycollabs[$key] = new collab($mycollab["id"]);
		}
		foreach($collabmember as $key => $collab)	{
			$collabmember[$key] = new collab($collab["id"]);
		}
	}
	else {
		die(header("Location: index.php?error=nologin"));
	}
?>
<html>
	<head>
		<title><?php echo __("My stuff"); ?> &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/mystuff.css" />
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
								<h3><?php echo __("My stuff"); ?></h3><span id='newcollab'><a href='new.php'><button class="button blue">+ <?php echo __("New collab"); ?></button></a></span>
							</div>
							<div class="box-content">
								<div class="inner">
									<?php
										echo "<ul id='msu'>";
										echo "<h4>" . __("My collabs") . "</h4>";
										if(count($mycollabs) > 0)	{
											//Collabliste
											echo "<div id='own'>";
											foreach($mycollabs as $collab)	{
												echo "<button class='button grey' onClick=\"navigate('admin.php?id=".$collab -> id ."');\">" . __("Administration") . "</button><li>";
												echo "<a href='collab.php?id=" . $collab -> id ."'><img src='logos/" . $collab -> logo . "' width='144' height='108' class='image' alt='" . $collab -> name . "' /></a>";
												echo "<table class='stats'>";
													echo "<tr><th>" . __("Name") . ":</th><td>" . $collab -> name . "</td></tr>";
													echo "<tr><th>" . __("Status") . ":</th><td>" . $collab -> status . "</td></tr>";
													echo "<tr><th>" . __("Rank") . ":</th><th>" . __("founder") . "</th></tr>";
												echo "</td></tr></table></li>";
											}
											echo "</div>";
										}
										else	{
											//Keine Collabs
											echo __("You don't have any own collabs.") . " <a href='new.php'>" . __("Start one") . "</a>!<hr/>";
										}
										echo "<h4>" . __("Member") . "</h4>";
										echo "<div id='member'>";
											$count = 0;
											foreach($collabmember as $collab)	{
												if(in_array($_USER -> name, $collab -> members["people"]))	{
													echo "<button class='button grey' onClick=\"navigate('action.php?leave&red&id=" . $collab -> id . "','Willst du wirklich aus dem Collab &bdquo;" . $collab -> name . "&ldquo; austreten?')\">Austreten</button><li>";
													echo "<a href='collab.php?id=" . $collab -> id . "'><img src='logos/" . $collab -> logo . "' width='144' height='108' class='image' alt='" . $collab -> name . "' /></a>";
													echo "<table class='stats'>";
														echo "<tr><th>" . __("Name") . ":</th><td>" . $collab -> name . "</td></tr>";
														echo "<tr><th>" . __("Status") . ":</th><td>" . $collab -> status . "</td></tr>";
														echo "<tr><th>" . __("Rank") . ":</th><td>" . __("Member") . "</td></tr>";
														echo "<tr><th>" . __("Founder") . ":</th><td>" . $collab -> owner -> name . "</td></tr>";
													echo "</td></tr></table></li>";
													$count++;
												}
											}
										if($count == 0) {
											echo __("You didn't join any other collab.") . " <a href='./'>" . __("Join now") . "</a>!<hr/>";
										}
										echo "</div></ul>";
									?>
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