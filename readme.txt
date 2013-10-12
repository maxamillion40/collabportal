Bitte committe mal nichts bis ich diese Anmerkung entfernt habe, ich habe einige gr��ere �nderungen vorgenommen.
Wann darf ich denn wieder weitermachen?

== Verzeichnisse ==
./		enth�lt alle Dateien des CollabPortals
./img		enth�lt alle Grafiken (au�er jQueryUI)
./includes	enth�lt den Footer, die Navigation und mysql Funktionen
./libs		alle PHP Skripts, die Aufgaben erledigen (Login, Registrierung, Collabbeitritt etc.)
./logos		hierhin werden alle Collablogos hochgeladen, wir arbeiten hier meistens nicht
./scripts	enth�lt alle Javascripts, einschlie�lich jQuery, jQueryUI und tinymce
./styles	hier sind die Stylesheets zu finden

== Dateien ==
./
	action.php	Wird von den Inhaltsseiten mit parameter aufgerufen und included die entsprechenden scripts
	*.php		Inhaltsseite

== Wie man Nachrichten sendet ==
$message = array(
	"sender" => "Absender",
	"to" => "Empf�nger",
	"msg" => "Nachricht (auch HTML)",
	"regard" => "Betreff; optional"
);
send_pm($message);
