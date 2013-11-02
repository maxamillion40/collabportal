<div id="footer">
	<p><ul id="footer-menu"><li><a href="contact.php">Kontakt</a></li><li><a href="about.php">Über ScratchCollabs</a></li><li><a href="team.php">Das Team</a></li><li><a href="termsofuse.php">Nutzungsbedingungen</a></li><li><a href="imprint.php">Impressum</a></li><li><a href="privacy.php">Datenschutz</a></li><li><a href="disclaimer.php">Haftungsausschluss</a></li><li><a href="http://scratch.mit.edu/about/">Über Scratch</a></li></ul></p>
	<p>Scratch ist ein Projekt der Lifelong-Kindergarten-Gruppe am Media-Lab des MIT</p>
	<p>ScratchCollabs ist ein Projekt von <a href="http://scratch.mit.edu/users/webdesigner97/">webdesigner97</a> und <a href="http://scratch.mit.edu/users/Lirex/">Lirex</a></p>
	<?php
		if(isset($_SERVER["__REQUEST_TIME"]))	{
			echo "<p id='dbtime'>DB-Zeit: " . $_SERVER["__REQUEST_TIME"] . "</p>";
		}
	?>
</div>