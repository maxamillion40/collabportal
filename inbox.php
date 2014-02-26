<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		header("Location: index.php");
	}
	$messages = array();
	$ids = $_MYSQL -> get("SELECT `id` FROM `messages` WHERE `to`=? AND `sender` <> 'System' ", array($_USER -> name));
	foreach($ids as $id)	{
		$messages[] = new message($id[0]);
	}
?>
<html>
	<head>
		<title><?php echo __("Inbox"); ?>  &raquo; ScratchCollabs in DACH</title>
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
		<script src="scripts/jquery.tablesorter.min.js"></script>
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
						<h3><?php echo __("Inbox"); ?></h3><span class='box-header-button'><a href='compose.php'><button class="button blue">+ <?php echo __("New message"); ?></button></a></span>
					</div>
					<div class="box-content">
						<div class="inner">
							<?php
								if(count($messages) > 0)	{
									echo "<p><label><input type='checkbox' id='select-all' /> " . __("Select all") . "</label></p>";
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
									echo "<thead>";
									echo "<tr>";
									echo "<th> </th>";
									echo "<th>" . __("Date") . "</th>";
									echo "<th>" . __("Sender") . "</th>";
									echo "<th>" . __("Regard") . "</th>";
									echo "<th> </th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									foreach($messages as $m)	{
										if($m -> read)	{
											echo "<tr id='msg-" . $m -> id . "'>";
												echo "<td><input type='checkbox' name='sel[]' value='" . $m -> id . "' /></td>";
												echo "<td><time datetime='" . $m -> date -> format("Y-m-d H:i") . "'>" . $m -> date -> format("d.m.Y H:i") . "</time></td>";
												echo "<td>" . $m -> sender -> name . "</td>";
												echo "<td id='msg-" . $m -> id . "'>" . $m -> regard . "</td>";
												if(!$m -> read)	{
													echo "<td>" . __("Unread") . "</td>";
												}
												else	{
													echo "<td>" . __("Read") . "</td>";
												}
											echo "</tr>";
										}
										else	{
											echo "<tr id='msg-" . $m -> id . "' class='unread'>";
											echo "<td><input type='checkbox' name='sel[]' value='" . $m -> id . "' /></td>";
											echo "<td class=''>" . $m -> date -> format("d.m.Y H:i") . "</td>";
											echo "<td>" . $m -> sender -> name . "</td>";
											echo "<td id='msg-" . $m -> id . "'>" . $m -> regard . "</td>";
											if(!$m -> read)	{
												echo "<td>" . __("Unread") . "</td>";
											}
											else	{
												echo "<td>" . __("Read") . "</td>";
											}
										echo "</tr>";
										}
									}
									echo "</tbody>";
									echo "</table>";
									echo "<hr /><p>" . __("Selected messages") . ": <select name='do-what'><option>" . __("Delete") . "</option><option>" . __("Mark as read") . "</option></select><button type='submit'>" . __("Go") . "!</button></p>";
									echo "</form>";
								}
							?>
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