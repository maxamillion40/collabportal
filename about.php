<?php
	session_start();
	require_once("includes/func.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Über &raquo; ScratchCollabs in DACH</title>
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
								<h4>Über ScratchCollabs</h4>
							</div>
							<div class="box-content">
								<div class="inner">
									<h4>Geschichte</h4>
										<p>ScratchCollabs wurde am 03.02.2013 von webdesigner97 ins Leben gerufen, um das deutsche Scratchforum zu entlasten und die Verwaltung von Collabs zu vereinfachen. 
										Es ist seit dem 08.08.2013 im Zuge der Umrüstung auf das aktuelle Design von Scratch eine Zusammenarbeit von <b>webdesigner97</b> und <b>Lirex</b> (<a href="team.php"><b>das Team</b></a>). 
										Bei Fragen kannst du in der <a href='help.php'>Hilfe</a> nachschauen oder dich gerne <a href="contact.php" >hier</a> an das Team wenden.</p>
									<h4>Ziele</h4>
										<p>ScratchCollabs soll das Verwalten von Collabs vereinfachen. Durch Funktionen wie das Zulassen und Kicken von Mitgliedern sowie der Geheimhaltung ist es einfach, Projekte in Ruhe zu Entwickeln.</p>
									<h4>Zukünftige Pläne</h4>
										<table id="planned">
											<tr>
												<th>Priorität</th>
												<th>Funktion</th>
												<th>Zuständiger</th>
												<th>Status</th>
												<th>Geplante Fertigstellung</th>
											</tr>
											<tr>
												<td>!</td>
												<td>CP in IE und Chrome zum laufen bekommen</td>
												<td>Team</td>
												<td>In Arbeit</td>
												<td>Unbekannt</td>
											</tr>
											<tr>
												<td>!</td>
												<td>Fehlerseite(n) ausbauen, insbesondere 404</td>
												<td>webdesigner97</td>
												<td>in Arbeit</td>
												<td>demnächst</td>
											</tr>
											<tr>
												<td>!</td>
												<td>Metadaten</td>
												<td>webdesigner97</td>
												<td>abgeschlossen</td>
												<td>FERTIG!</td>
											</tr>
											<tr>
												<td>-</td>
												<td>"Über" und Hilfeseiten ausbauen</td>
												<td>Lirex</td>
												<td>In Arbeit</td>
												<td>Bald</td>
											</tr>
											<tr>
												<td>-</td>
												<td>Nachrichtensystem</td>
												<td>webdesigner97</td>
												<td>abgschlossen</td>
												<td>FERTIG!</td>
											</tr>
											<tr>
												<td>-</td>
												<td>Mitgliederliste</td>
												<td>webdesigner97</td>
												<td>abgeschlossen</td>
												<td>FERTIG!</td>
											</tr>
											<tr>
												<td>-</td>
												<td>Passwortoptionen (E-Mail) und Profileinstellungen</td>
												<td>-</td>
												<td>Ausstehend</td>
												<td>Unbekannt</td>
											</tr>
											<tr>
												<td>?</td>
												<td>Englische Version</td>
												<td>-</td>
												<td>Realisierung fragwürdig</td>
												<td>Unbekannt</td>
											</tr>
											<tr>
												<td>?</td>
												<td>Mobile Version</td>
												<td>-</td>
												<td>Realisierung fragwürdig</td>
												<td>Unbekannt</td>
											</tr>
											<tr>
												<td colspan="5">Zögere nicht, Vorschläge für neue Funktionen <a href="./" >hier</a> einzureichen.</td>
											</tr>
											<tr>
												<td colspan="5">Release spätestens am: 01.01.2014 14:00 Uhr</td>
											</tr>
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