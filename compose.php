<!DOCTYPE html>
<?php
	require_once("includes/loader.php");
	if(!$_USER -> is_online())	{
		header("Location: index.php");
	}
	$messages = array();
	$ids = $_MYSQL -> get("SELECT id FROM messages WHERE `to`='" . $_USER -> name . "' ORDER BY `read` ASC, `date` DESC");
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
	</head>
	<body>
		<div id="pagewrapper">
			<!-- This is the blue box on the top of the site -->
				<?php
					include_once("includes/topnav.php");
				?>
			<!-- Main Content -->	
			<div class="container" id="content">
				<article class="box" id="new">
					<div class="box-head">
						<h4><?php echo __("New message"); ?></h4>
					</div>
					<div class="box-content">
						<div class="inner">
							<form action="action.php?sendmessage" method="post">
								<input type="text" name="sendto" placeholder="<?php echo __("Recipient"); ?>" required onBlur="javascript: divide_sendto();" value="<?php if(isset($_GET["to"])) { echo $_GET["to"] . ";"; } ?>" />
								<input type="text" name="regard" placeholder="<?php echo __("Regard"); ?>" value="<?php if(isset($_GET["regard"])) { echo $_GET["regard"]; } ?>" />
								<textarea name="msg"></textarea>
								<input type="submit" value="<?php echo __("Send"); ?>" class="button grey" />
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