<?php
	session_start();
	require_once("includes/func.php");
	if(!is_loggedin())	{
		header("Location: index.php");
	}
	mysql_auto_connect();
	$msg = mysql_real_escape_string($_GET["id"]);
	$msg = explode("-",$msg);
	$msg = $msg[1];
	$msg = mysql_get("SELECT * FROM `messages` WHERE `id`='$msg'");
	$msg = $msg[0];
	if($msg["to"] != $_SESSION["user"])	{
		header("Location: messages.php?error=nopriv");
		print_array($msg);
	}
	if($msg["read"] == 0)	{
		mysql_query("UPDATE `messages` SET `read`='1' WHERE `id`='".$msg["id"]."'");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Persönliche Nachricht &raquo; ScratchCollabs in DACH</title>
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
						<article class="box">
							<div class="box-head">
								<h3><?php echo $msg["regard"]; ?></h3>
								<span class="box-header-button">
									<?php
										if($msg["sender"] != "Systemnachricht")	{
											echo "<a href='messages.php?to=".$msg["sender"]."&regard=Re: ".$msg["regard"]."#new'><button class='button blue'>Antworten</button></a>";
										}
									?>
									<a href="action.php?delete&id=<?php echo $msg["id"]; ?>"><button class="button grey">Löschen</button></a>
								</span>
							</div>
							<div class="box-content">
								<div class="inner box-no-padding">
									<div id="msg-head">
										<p><?php echo $msg["sender"]; ?> am <?php echo date("d.m.Y \u\m H:i",$msg["date"]); ?></p>
									</div>
									<div id="msg-body">
										<?php
											echo $msg["msg"];
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