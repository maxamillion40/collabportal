Bitte committe mal nichts bis ich diese Anmerkung entfernt habe, ich habe einige größere Änderungen vorgenommen.

== Verzeichnisse ==
./		enthält alle Dateien des CollabPortals
./img		enthält alle Grafiken (außer jQueryUI)
./includes	enthält den Footer, die Navigation und mysql Funktionen
./libs		alle PHP Skripts, die Aufgaben erledigen (Login, Registrierung, Collabbeitritt etc.)
./logos		hierhin werden alle Collablogos hochgeladen, wir arbeiten hier meistens nicht
./scripts	enthält alle Javascripts, einschließlich jQuery, jQueryUI und tinymce
./styles	hier sind die Stylesheets zu finden

== Dateien ==
./
	action.php	Wird von den Inhaltsseiten mit parameter aufgerufen und included die entsprechenden scripts
	*.php		Inhaltsseite

== Wie man Nachrichten sendet ==
$message = array(
	"sender" => "Absender",
	"to" => "Empfänger",
	"msg" => "Nachricht (auch HTML)",
	"regard" => "Betreff; optional"
);
send_pm($message);