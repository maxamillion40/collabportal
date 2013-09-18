<?php
	session_start();
	require_once("includes/func.php");
	if(!is_loggedin())	{
		header("Location: index.php");
	}
	mysql_auto_connect();
	$unread = count(mysql_get("SELECT * FROM `messages` WHERE `to`='".$_SESSION["user"]."' AND `read`='0'"));
	$msg = mysql_get("SELECT * FROM `messages` WHERE `to`='".$_SESSION["user"]."' ORDER BY `read` ASC, `date` DESC");
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Posteingang  &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/cp.css" />
		<link rel="stylesheet" href="styles/messages.css" />
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
				<article class="box">
					<div class="box-head">
						<h4>Posteingang</h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<p>
								<?php
									if($unread == 1)	{
										echo "Du hast 1 ungelesene Nachricht.";
									}
									else	{
										echo "Du hast ".$unread." ungelesene Nachrichten.";
									}
								?>
							</p>
							<?php
								if(count($msg) > 0)	{
									echo "<table id='msg-table'>";
									echo "<colgroup>";
									echo "<col class='sendtime' />";
									echo "<col class='sender' />";
									echo "<col class='regard' />";
									echo "<col class='read' />";
									echo "</colgroup>";
									foreach($msg as $m)	{
										echo "<tr>";
											echo "<td class=''>".date("d.m.Y H:i",$m["date"])."</td>";
											echo "<td>".$m["sender"]."</td>";
											echo "<td>".$m["regard"]."</td>";
											if($m["read"] == "0")	{
												echo "<td>Ungelesen</td>";
											}
											else	{
												echo "<td>Gelesen</td>";
											}
										echo "</tr>";
									}
									echo "</table>";
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