<?php
	require_once("includes/loader.php");
	if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["scratch"]) && isset($_POST["pass"]) && isset($_POST["pass_check"]))	{
		//Alle Daten vorhanden. Einlesen:
		$users = $_MYSQL -> get("SELECT * FROM users");
		$username	= ucfirst($_POST["name"]);
		$mail		= $_POST["email"];
		$scratch	= $_POST["scratch"];
		$pass		= $_POST["pass"];
		$pass_check	= $_POST["pass_check"];
		//Prüfung der Daten
			// 1. Existiert der Username bereits?
			foreach($users as $user)	{
				if($user["name"] == $username)	{
					die(header("Location: join.php?view=signup&error=namenotavailable&email=$mail&scratch=$scratch"));
				}
			}
			echo "Name ok.<br />";
			//2. Ist die Mailadresse ok?
			if(substr_count($mail,"@") != 1 or substr_count($mail,".") < 1)	{
				die(header("Location: join.php?view=signup&error=badmail&scratch=$scratch&name=$username"));
			}
			echo "Mail ok.<br />";
			//3. Existiert das Scratch Profil?
			if(!@file_get_contents("http://scratch.mit.edu/users/$scratch"))	{
				die(header("Location: join.php?view=signup&error=badprofile&name=$username&email=$mail"));
			}
			echo "Scratch Profil ok.<br />";
			//3. Stimmen $pass und $pass_check überein?
			if($pass != $pass_check)	{
				die(header("Location: join.php?view=signup&error=badpassb&scratch=$scratch&name=$username&email=$mail"));
			}
			echo "Passwort ok.";
			//4. Wurde die Mailadresse schonmal benutzt?
			foreach($users as $user)	{
				if($user["mail"] == $mail)	{
					die(header("Location: join.php?view=signup&error=mailnotavailable&name=$username&scratch=$scratch"));
				}
			}
			echo "Mail wieder ok.<br />";
		//Daten in Datenbank eintragen und abschließen.
		$_MYSQL -> set("INSERT INTO users(`name`,`pass`,`mail`,`scratch`) VALUES('$username','".md5($pass)."','$mail','$scratch')");
		header("Location: index.php?result=signup&name=$username");
	}
?>