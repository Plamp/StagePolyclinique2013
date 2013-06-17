<?php
	// Ouverture des sessions
	session_start();

	// Création d'une image
	header ("Content-type: image/png");
	$image = imagecreate(70,20);

	// Définition des couleur et coloriage du fond en noir
	$noir  = imagecolorallocate($image, 0, 0, 0);
	$blanc = imagecolorallocate($image, 255, 255, 255);
	$gris  = imagecolorallocate($image, 150, 150, 150);

	// Le nombre de ligne est pour le moment de zéro
	$nb = 0;

	// On va dessinné ligne par ligne jusqu'a 7
	while ( $nb < 7 ) {

		// On défini le point de départ et d'arrivé en X
		$xd = rand(0,70);
		$xa = rand(0,70);

		// Si le point de départ de X=0 alors en Y on part d'ou on veut
		// Sinon le point de départ est forcément à 20
		if ( $xd == 0 ) {
			$yd = rand(0,19);
		}
		else {
			$yd = 0;
		}

		// Si le point d'arrivé de X=70 alors en Y on arrive ou on veut
		// Sinon le point d'arrivé est forcément à 19
		if ( $xa == 70 ) {
			$ya = rand(0,19);
		}
		else {
			$ya = 19;
		}

		// On dessine la ligne
		ImageLine ($image, $xd, $yd, $xa, $ya, $gris);

		// Et on prépar pour la lign suivante
		$nb++;
	}

	// On écrit le captcha
	imagestring($image, 5, 8, 2, $_SESSION['captcha'], $blanc);

	// On génère l'image
	imagepng($image);
?>
