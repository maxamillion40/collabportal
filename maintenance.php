<?php
	session_start();
	require_once("includes/func.php");
	if($_SESSION["user"] != "webdesigner97" and $_SESSION["user"] != "lirex")	{
		header("HTTP/1.1 403");
		header("Location: index.php?error=noaccess");
		exit;
	}
	//
	mysql_auto_connect();
	$news = mysql_get("SELECT * FROM `news` ORDER BY `date` DESC");
	$questions = mysql_get("SELECT * FROM `faq` WHERE `answer`='unbeantwortet'");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Adminbereich &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="index,follow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/maintenance.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/init.js"></script>
		<script src="scripts/maintenance.js"></script>
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
								<h4>Ankündigungen</h4>
							</div>
							<div class="box-content">
								<div class="inner box-no-padding">
									<ul class="event-list">
										<?php
											$i = 1;
											foreach($news as $entry)	{
												if($i > 3)	{
													echo "<li id='event-".$entry["id"]."' class='invisible'>";
												}
												else	{
													echo "<li id='event-".$entry["id"]."'>";
												}
												echo "<div class='event-actions'>";
												echo "<a onClick='navigate(\"action.php?delnews&id=".$entry["id"]."\", \"Wirklich löschen?\");'><button class='button grey'>Löschen</button></a>";
												echo "</div>";
												echo "<img id='event-img-".$entry["id"]."' class='event-img' src='img/".$entry["pic"]."' alt='News' width='54' height='54' />";
												echo "<div class='msg-content'>";
												echo "<p id='event-headline-".$entry["id"]."' class='event-headline'>".$entry["headline"]." (".date("d.m.Y",$entry["date"]).")</p>";
												echo "<p id='event-msg-".$entry["id"]."'class='event-msg'>".$entry["msg"]."</p>";
												echo "</div>";
												echo "</li>";
												$i++;
											}
										?>
									</ul>
								</div>
							</div>
						</article>
						<article class="box">
							<div class="box-head">
								<h4>Neue Ankündigung</h4>
							</div>
							<div class="box-content">
								<div class="inner min">
									<form id="news" action="action.php?newnews" method="post">
										<select name="pic">
											<option onClick="$('#event-preview-img').attr('src','img/icon_info.png');">info</option>
											<option onClick="$('#event-preview-img').attr('src','img/icon_update.png');">update</option>
										</select>
										<input onKeyUp="update('headline-input','event-preview-headline');" id="headline-input" name="headline" placeholder="Titel" required /><br />
										<input onKeyUp="update('msg-input','event-preview-msg');" id="msg-input" name="msg" placeholder="Nachricht" required />
										<input type="submit" class="button blue" value="Speichern" />
									</form>
									<ul id="event-preview">
										<li>
											<img id="event-preview-img" class="event-img" src="img/icon_info.png" alt="" width="54" height="54" />
											<div class="msg-content">
												<p id="event-preview-headline" class="event-headline"></p>
												<p id="event-preview-msg" class="event-msg"></p>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</article>
						<article class="box">
							<div class="box-head">
								<h4>Offene Fragen (<?php echo count($questions); ?>)</h4>
							</div>
							<div class="box-content">
								<div class="inner box-no-padding">
									<?php
										foreach($questions as $q)	{
											echo "<div class='question'>";
											echo "<form action='action.php?answer&id=".$q["id"]."' method='post'>";
											echo "Frage: <input type='text' name='question' value='".$q["question"]."' /></p>";
											echo "Antwort: <input type='text' name='answer' required />";
											echo "<button type='submit' class='button blue'>Frage beantworten</button>";
											echo "</form>";
											echo "</div>";
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