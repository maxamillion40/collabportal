<?php
/* Benachrichtigungen */
    resnotice("login","Willkommen zurück!");
    resnotice("logout","Du wurdest ausgeloggt. Bis bald!");
    resnotice("censored","Die Nachricht wurde zensiert!");
    resnotice("msgok","Deine Nachricht wurde gespeichert!");
    resnotice("signup","Dein Account wurde angelegt, ".$name.".");
	resnotice("joinok","Du bist nun Mitglied!");
	resnotice("leaveok","Du bist soeben ausgetreten!");
/* Fehlermeldungen */
    errnotice("notin","Du bist kein Mitglied in diesem Collab!");
    errnotice("alreadyin","Du bist bereits Mitglied in diesem Collab!");
    errnotice("own","Du kannst aus deinem Collab nicht austreten!");
    errnotice("notext","Du hast keine Nachricht eingegeben!");
    errnotice("nologin","Logge dich ein, um deine Collabs zu betrachten!");
    errnotice("noid","Interner Fehler, konnte Nachricht nicht zuordnen!");
    errnotice("unknownuser","Dieser Nutzer existiert nicht!");
    errnotice("badpass","Falsches Passwort oder Nutzername!");
    errnotice("namenotavailable","Dieser Nutzername ist nicht verfügbar!");
    errnotice("badmail","Das scheint keine gültige Email Adresse zu sein.");
    errnotice("badprofile","Dieses Scratchprofil existiert nicht!");
    errnotice("badpassb","Die Passwörter stimmen nicht überein!");
    errnotice("badpasslogin","Das Passwort war leider nicht korrekt!");
    errnotice("mailnotavailable","Diese Email Adresse wird bereits verwendet!");
?>