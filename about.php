<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	//Load Github Issues
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/webdesigner97/collabportal/issues");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
	$githubISSUES = json_decode(curl_exec($ch));
?>
<html>
	<head>
		<title><?php echo __("About"); ?> &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="index,follow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/about.css" />
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
				<div class="cols clearfix" style="top: -10px; padding-left: 10px; padding-right: 10px;">
					<!-- Über -->	
						<article class="box ">
							<div class="box-head">
								<h4><?php echo __("About Scratchcollabs"); ?></h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<h4><?php echo __("History"); ?></h4>
										<p>ScratchCollabs wurde am 03.02.2013 von webdesigner97 ins Leben gerufen, um das deutsche Scratchforum zu entlasten und die Verwaltung von Collabs zu vereinfachen. 
										Es ist seit dem 08.08.2013 im Zuge der Umrüstung auf das aktuelle Design von Scratch eine Zusammenarbeit von <b>webdesigner97</b> und <b>Lirex</b> (<a href="team.php"><b>das Team</b></a>). 
										Bei Fragen kannst du in der <a href='help.php'>Hilfe</a> nachschauen oder dich gerne <a href="contact.php" >hier</a> an das Team wenden.</p>
									<h4><?php echo __("Goals"); ?></h4>
										<p>ScratchCollabs soll das Verwalten von Collabs vereinfachen. Durch Funktionen wie das Zulassen und Kicken von Mitgliedern sowie der Geheimhaltung ist es einfach, Projekte in Ruhe zu Entwickeln.</p>
									<h4><?php echo __("Future plans"); ?></h4>
										<?php
											if(count($githubISSUES) > 0 && !isset($githubISSUES -> message))	{
										?>
										<table id="planned">
											<tr>
												<th><?php echo __("ID"); ?></th>
												<th><?php echo __("Functions");; ?></th>
												<th><?php echo __("Assignee"); ?></th>
												<th><?php echo __("Status"); ?></th>
											</tr>
											<?php
												foreach($githubISSUES as $issue)	{
											?>
												<tr>
													<td>#<?php echo $issue -> number; ?></td>
													<td><a href="<?php echo $issue -> html_url ?>" target="_blank"><?php echo $issue -> title; ?></a></td>
													<td><?php
														if(isset($issue -> assignee -> login))	{
														 echo $issue -> assignee -> login;
														}
														else	{
															echo "---";
														}
													?></td>
													<td><?php echo $issue -> state; ?></td>
												</tr>
											<?php
												}
											?>
											<tr>
												<td colspan="4"><?php echo __("Feel free to suggest new features"); ?> <a href="./" ><?php echo __("Official forum topic"); ?></a></td>
											</tr>
											<tr>
												<td colspan="4">Release spätestens am: xx.xx.2014</td>
											</tr>
										</table>
										<?php
											}
											else	{
										?>
										<p><?php echo __("Currently not available. Please try again later."); ?></p>
										<?php
											}
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