<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		header("Location: index.php");
	}
	//$unread = count(mysql_get("SELECT `id` FROM `messages` WHERE `to`='".$_SESSION["user"]."' AND `read`='0'"));
	//$msg = mysql_get("SELECT * FROM `messages` WHERE `to`='".$_SESSION["user"]."' ORDER BY `read` ASC, `date` DESC");
	//mysql_close();
	$messages = array();
	$ids = $_MYSQL -> get("SELECT id FROM messages WHERE `to`='" . $_USER -> name . "'");
	foreach($ids as $id)	{
		$messages[] = new message($id[0]);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Posteingang  &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/messages.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- Scripts -->
		<script src="scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="scripts/tinymce/tinymce.min.js"></script>
		<script src="scripts/init.js"></script>
		<script src="scripts/messages.js"></script>
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
						<h3>Posteingang</h3><span class='box-header-button'><a href='#new'><button class="button blue">+ Neue Nachricht</button></a></span>
					</div>
					<div class="box-content">
						<div class="inner">
							<?php
								if(count($messages) > 0)	{
									echo "<p><label><input type='checkbox' id='select-all' /> Alle auswählen</label></p>";
									echo "<hr />";
									echo "<form action='action.php?msgdo' method='post'>";
									echo "<table id='msg-table'>";
									echo "<colgroup>";
									echo "<col class='check'>";
									echo "<col class='sendtime' />";
									echo "<col class='sender' />";
									echo "<col class='regard' />";
									echo "<col class='read' />";
									echo "</colgroup>";
									foreach($messages as $m)	{
										if($m -> read)	{
											echo "<tr id='msg-" . $m -> id . "'>";
												echo "<td><input type='checkbox' name='sel[]' value='" . $m -> id . "' /></td>";
												echo "<td class=''>" . $m -> date -> format("d.m.Y H:i") . "</td>";
												echo "<td>" . $m -> sender -> name . "</td>";
												echo "<td>" . $m -> regard . "</td>";
												if(!$m -> read)	{
													echo "<td>Ungelesen</td>";
												}
												else	{
													echo "<td>Gelesen</td>";
												}
											echo "</tr>";
										}
										else	{
											echo "<tr id='msg-" . $m -> id . "' class='unread'>";
											echo "<td><input type='checkbox' name='sel[]' value='" . $m -> id . "' /></td>";
											echo "<td class=''>" . $m -> date -> format("d.m.Y H:i") . "</td>";
											echo "<td>" . $m -> sender -> name . "</td>";
											echo "<td>" . $m -> regard . "</td>";
											if(!$m -> read)	{
												echo "<td>Ungelesen</td>";
											}
											else	{
												echo "<td>Gelesen</td>";
											}
										echo "</tr>";
										}
									}
									echo "</table>";
									echo "<hr /><p>Ausgewählte Nachrichten <select name='do-what'><option>Löschen</option><option>Als gelesen markieren</option></select><button type='submit'>Los!</button></p>";
									echo "</form>";
								}
							?>
						</div>
					</div>
				</article>
				<article class="box" id="new">
					<div class="box-head">
						<h4>Neue Nachricht</h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<form action="action.php?sendmessage" method="post">
								<input type="text" name="sendto" placeholder="Empfänger" required onBlur="javascript: divide_sendto();" value="<?php if(isset($_GET["to"])) { echo $_GET["to"] . ";"; } ?>" />
								<input type="text" name="regard" placeholder="Betreff" value="<?php if(isset($_GET["regard"])) { echo $_GET["regard"]; } ?>" />
								<textarea name="msg"></textarea>
								<input type="submit" value="Senden" class="button grey" />
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