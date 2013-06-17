<?php
	// Ouverture des sessions
	session_start();

	// Cr�ation d'une image
	header ("Content-type: image/png");
	$image = imagecreate(70,20);

	// D�finition des couleur et coloriage du fond en noir
	$noir  = imagecolorallocate($image, 0, 0, 0);
	$blanc = imagecolorallocate($image, 255, 255, 255);
	$gris  = imagecolorallocate($image, 150, 150, 150);

	// Le nombre de ligne est pour le moment de z�ro
	$nb = 0;

	// On va dessinn� ligne par ligne jusqu'a 7
	while ( $nb < 7 ) {

		// On d�fini le point de d�part et d'arriv� en X
		$xd = rand(0,70);
		$xa = rand(0,70);

		// Si le point de d�part de X=0 alors en Y on part d'ou on veut
		// Sinon le point de d�part est forc�ment � 20
		if ( $xd == 0 ) {
			$yd = rand(0,19);
		}
		else {
			$yd = 0;
		}

		// Si le point d'arriv� de X=70 alors en Y on arrive ou on veut
		// Sinon le point d'arriv� est forc�ment � 19
		if ( $xa == 70 ) {
			$ya = rand(0,19);
		}
		else {
			$ya = 19;
		}

		// On dessine la ligne
		ImageLine ($image, $xd, $yd, $xa, $ya, $gris);

		// Et on pr�par pour la lign suivante
		$nb++;
	}

	// On �crit le captcha
	imagestring($image, 5, 8, 2, $_SESSION['captcha'], $blanc);

	// On g�n�re l'image
	imagepng($image);
?>
