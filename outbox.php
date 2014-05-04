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
	$messages = array();
	$ids = $_MYSQL -> get("SELECT id FROM messages WHERE `sender`='" . $_USER -> name . "' ORDER BY `date` DESC");
	foreach($ids as $id)	{
		$messages[] = new message($id[0]);
	}
	
	$_PAGE -> setTitle(__("Outbox"));
	$_PAGE -> setRobots(array("noindex", "nofollow"));
	$_PAGE -> useScript("jquery");
	$_PAGE -> useScript("tinymce");
	$_PAGE -> useScript("tablesorter");
	$_PAGE -> useScript("scripts/messages.js");
	$_PAGE -> useStyle("styles/messages.css");
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
					<div class="box-head">
						<h3><?php echo __("Outbox"); ?></h3><span class='box-header-button'><a href='compose.php'><button class="button blue">+ <?php echo __("New message"); ?></button></a></span>
					</div>
					<div class="box-content">
						<div class="inner">
							<?php
								if(count($messages) > 0)	{
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
									echo "<th>" . __("Recipient") . "</th>";
									echo "<th>" . __("Regard") . "</th>";
									echo "<th> </th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									foreach($messages as $m)	{
										echo "<tr id='msg-" . $m -> id . "'>";
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
									echo "</tbody>";
									echo "</table>";
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