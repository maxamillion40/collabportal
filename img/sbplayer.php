<?php
	//Header vorbereiten, da eine Grafik ausgegeben wird, kein HTML
	header("Content-type: image/png");
	//Ist die einzubindende Grafik in der URL enthalten?
	if(!isset($_GET["id"]))	{
		die();
	}
	//Lade den Rahmen und das Projekt-Thumbnail und die Flagge
	$frame	= imagecreatefrompng("sb_empty.png");
	$flag	= imagecreatefrompng("player_flag.png");
	$thumb	= imagecreatefrompng("http://cdn.scratch.mit.edu/get_image/project/".$_GET["id"]."_480x360.png");
	//Erzeuge eine leere Grafik und mache sie weiß
	$both	= imagecreatetruecolor(482,387);
	$white = imagecolorallocate($both, 255, 255, 255);
	imagefill($both, 0, 0, $white);
	//Füge den Frame zur Grafik hinzu
	imagecopy($both, $frame, 0, 0, 0, 0, 482,387);
	//Füge das Thumbnail hinzu
	imagecopy($both, $thumb, 1, 27, 0, 0, 480,360);
	//Füge die Flagge hinzu
	imagecopy($both, $flag, 1, 27, 0, 0, 480,360) or die(header("Content-Type: text/plain"));
	//Fertig
	imagepng($both);
	imagedestroy($frame);
	imagedestroy($thumb);
	imagedestroy($flag);
	imagedestroy($both);
?>