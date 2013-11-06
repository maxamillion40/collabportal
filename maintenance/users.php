<?php
	session_start();
	set_include_path($_SERVER["DOCUMENT_ROOT"]."/collabs2");
	require_once("includes/func.php");
	mysql_auto_connect();
	$class = mysql_get("SELECT `class` FROM `users` WHERE `name`='".$_SESSION["user"]."'")[0]["class"];
	if($class != "Moderator" and $class != "Administrator")	{
		header("HTTP/1.1 403");
		header("Location: ../error403.php?error=noaccess");
		exit;
	}
	//
	$users = mysql_get("SELECT * FROM `users` ORDER BY `name` ASC");
	$class = mysql_get("SELECT `class` FROM `users` WHERE `name`='".$_SESSION["user"]."'");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>User Verwaltung &raquo; ScratchCollabs in DACH</title>
		<!-- Meta -->
		<meta charset="utf-8" />
		<meta name="description" content="Das CollabPortal ermöglicht es dir, auf einfache Weise Scratch Collabs zu erstellen, zu verwalten und zu veranstalten." />
		<meta name="keywords" content="scratch,collabs,dach,deutsch" />
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<!-- Stylesheets -->
		<link rel="stylesheet" href="../styles/main.css" />
		<link rel="stylesheet" href="../styles/cp.css" />
		<link rel="stylesheet" href="../styles/maintenance.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="../favicon.ico" />
		<!-- Scripts -->
		<script src="../scripts/jquery/jquery-1.10.2.min.js"></script>
		<script src="../scripts/jquery.tablesorter.min.js"></script>
		<script src="../scripts/init.js"></script>
		<script src="../scripts/maintenance.js"></script>
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
						<article class="box">
							<div class="box-head">
								<h3><a href="index.php">Übersicht</a> &rarr; Benutzer</h3>
							</div>
							<div class="box-content">
								<div class="inner">
									<input type="text" id="search" placeholder="Suchen..." style="display: inline;" /><button class="button blue" onClick="javascript: search($('#search').val());">Los</button><button class="button grey" onClick="javascript: reset();">Reset</button>
									<table id="userlist">
										<thead>
											<tr>
												<th>#</th>
												<th class="headerSortDown">Name</th>
												<th>E-Mail</th>
												<th>Scratch Account</th>
												<th>Letzte IP</th>
												<th>Letzter Login</th>
												<th>Rang</th>
												<th>Rang ändern</th>
											</tr>
										</thead>
										<tbody>
											<?php
												foreach($users as $u)	{
													echo "<tr>";
													echo "<td>".$u["id"]."</td>";
													echo "<td>".$u["name"]."</td>";
													echo "<td>".$u["mail"]."</td>";
													echo "<td><a href='http://scratch.mit.edu/users/".$u["name"]."' target='_blank'>".$u["name"]."</a></td>";
													echo "<td>".$u["last_ip"]."</td>";
													echo "<td>".date("d.m.Y H:i",$u["last_login"])."</td>";
													echo "<td>".$u["class"]."</td>";
													if($u["class"] != "Administrator")	{
														echo "<td><select><option onClick='navigate(\"../action.php?classchange&id=".$u["id"]."&class=User\")'>User</option><option onClick='navigate(\"../action.php?classchange&id=".$u["id"]."&class=Moderator\")'>Moderator</option><option onClick='navigate(\"../action.php?classchange&id=".$u["id"]."&class=Banned\")'>Banned</option></select></td>";
													}
													else	{
														echo "<td>---</td>";
													}
													echo "</tr>";
												}
											?>
										</tbody>
									</table>
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