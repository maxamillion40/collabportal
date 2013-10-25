<?php
/* Benachrichtigungen */
    resnotice("login",				"Willkommen zurück!");
    resnotice("logout",				"Du wurdest ausgeloggt. Bis bald!");
    resnotice("censored",			"Die Nachricht wurde zensiert!");
    resnotice("msgok",				"Deine Nachricht wurde gespeichert!");
    resnotice("signup",				"Dein Account wurde angelegt, ".$name."!");
	resnotice("joinok",				"Du bist nun Mitglied!");
	resnotice("leaveok",			"Du bist soeben ausgetreten!");
	resnotice("kickok",				"Mitglied gekickt!");
	resnotice("sent",				"Nachricht gesendet!");
	resnotice("settingsok",			"Die Einstellungen wurden aktualsisiert!");
	resnotice("applicationok",		"Dein Beitrittantrag wurde versendet!");
	resnotice("acceptok",			"Mitglied aufgenommen!");
	resnotice("delok",				"Nachricht gelöscht!");
/* Fehlermeldungen */
    errnotice("notin",				"Du bist kein Mitglied in diesem Collab!");
    errnotice("alreadyin",			"Du bist bereits Mitglied in diesem Collab!");
    errnotice("own",				"Du kannst aus deinem Collab nicht austreten!");
    errnotice("notext",				"Du hast keine Nachricht eingegeben!");
    errnotice("nologin",			"Logge dich ein, um deine Collabs zu betrachten!");
    errnotice("noid",				"Interner Fehler, konnte Nachricht nicht zuordnen!");
    errnotice("unknownuser",		"Dieser Nutzer existiert nicht!");
    errnotice("badpass",			"Falsches Passwort oder Nutzername!");
    errnotice("namenotavailable",	"Dieser Nutzername ist nicht verfügbar!");
    errnotice("badmail",			"Das scheint keine gültige Email Adresse zu sein.");
    errnotice("badprofile",			"Dieses Scratchprofil existiert nicht!");
    errnotice("badpassb",			"Die Passwörter stimmen nicht überein!");
    errnotice("badpasslogin",		"Das Passwort war leider nicht korrekt!");
    errnotice("mailnotavailable",	"Diese Email Adresse wird bereits verwendet!");
	errnotice("badaction",			"Diese Aktion konnte nicht ausgeführt werden!");
	errnotice("nopriv",				"Du bist kein Empfänger dieser Nachricht!");
	errnotice("nocollab",			"Fehler beim Auslesen der Datenbank!");
	errnotice("emptyfields",		"Du hast nicht alle Felder ausgefüllt!");
	errnotice("nopage",				"Diese Seite existiert nicht!");
	errnotice("notmine",			"Dieses Collab gehört dir nicht!");
	errnotice("notyours",			"Diese Nachricht konnte nicht gelöscht werden!");
?>