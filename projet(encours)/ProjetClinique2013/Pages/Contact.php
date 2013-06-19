<?php 
// On initialise les sessions
	session_start();

	if ( !empty($_POST['captcha']) ) {
		$captchacrypte = md5($_SESSION['captcha']);

		// On supprime la session pour éviter la récupération pour les robots
		$_SESSION['captcha'] = '';
	}
	
	// On pr�pare la liste de caractère a inséré dans le captcha
	$chaine = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9');

	// On pr�pare le compteur de caract�re
	$nb = 0;
$chaine2='';
	// On limite à 6 caractéres
	while( $nb < 6 ) {

		// On tire un nombre au hasard
		$rand = rand(0,34);

		// On regarde à quelle lettre il correspond et on l'ajoute à la chaine
		$chaine2 .= $chaine[$rand];

		// On prépare pour la lettre suivante
		$nb++;
	}

	// Enfin on génére la session
	$_SESSION['captcha'] = $chaine2;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include ("../style/style.css");?>
<?php include("../include/entete.php");?>
<body>

<h2><center><strong>Nous contacter:</strong></center></h2>
<p style="text-align: center;"><span style="font-size: large;">3 - 5, rue Antonin Coronat</span></p>
<p style="text-align: center;"><span style="font-size: large;">05000 Gap</span></p>
<p style="text-align: center;"><span style="font-size: large;"><strong>Tél.</strong> 0 826 555 001</span></p>
<h3><center><b>Envoyer un message :</b></center></h3>
<center>Indiquez une adresse mail valide:</center>
	<form method="post" action="">
<center><input type="text" name="email" size="40" <?php if(isset ($captchacrypte) && isset($_POST['captcha'])) 
{
	$email=$_POST["email"];
	echo "value='$email'";
}?>/></center><br />
<center>insérez le contenu de votre message:</center>
<center><textarea name="contenu" style="width:500px;height:100px" ><?php if(isset ($captchacrypte) && isset($_POST['captcha']))
{
	$contenu=$_POST["contenu"];
	echo "$contenu";
}?></textarea></center><br />

	<center><img src="../Captcha/captcha.php" /></center><br />
<?php

//_____________________________________________________________________________________________________________________________________//
//-------------------------------------------------Envoi de mail avec verification par captcha ----------------------------------------//
//_____________________________________________________________________________________________________________________________________//

if(isset ($captchacrypte) && isset($_POST['captcha']))
{
	//test pour savoir si contenu ou email est vide
	if(!empty($_POST["email"]) && !empty($_POST['contenu']))
	{
	if ( $captchacrypte == md5($_POST['captcha']) AND !empty($_POST['captcha']) ) {
		$email=$_POST["email"];
		$contenu=$_POST["contenu"];
		//header du mail.
		 $headers ='From:"Nous contacter"<'.$email.'>'."\n"; 
		 $headers .='Reply-To:'.$email. "\r\n";
	  $headers .='Content-Type: text/html; charset="UTF-8"'."\n"; 
	  $headers .='Content-Transfer-Encoding: 8bit'; 
	  //envoi du mail
	 if( mail('melindrae@gmail.com', 'Message depuis  la page" Nous contacter "', $contenu, $headers))
	 {
			echo "<center>\t\t\t<B style=\"color : #00ff00;\">Votre message à été envoyé</b></center><br />\n"; 
	 }
	 else
	 {
	echo "<center>\t\t\t<B style=\"color : #ff0000;\">Adresse mail invalide, veuillez la ressaisir </b></center><br />\n";
	 }
	}
	else if ( !empty($_POST['captcha']) ) {
		echo "<center>\t\t\t<B style=\"color : #ff0000;\">Erreur lors de la saisie du captcha, veuillez ressaisir </b></center><br />\n";
	}
	// si un champ est vide alors :
	}
	else
	{
	echo "<center>\t\t\t<B style=\"color : #ff0000;\">veuillez remplir tout les champs , merci. </b></center><br />\n";
	}
	//fin test
}
?>
		
				<center>Recopiez : <input type="text" name="captcha" size=6 maxlength=6 /></center>
				<center><input type="submit"  name="contact" value="Valider" /></center>
			</form>




<?php //---------------------------------------------------------------------------------------------------------------//?>
<p style="text-align: center;">________________________________</p>
<h2><p align="center"><strong>Venir à la Polyclinique des Alpes du Sud.</strong></p></h2>
<p style="text-align: center;"><img style="border: 1px solid black;" title="Plan d'accès." src="../Image/plan_acces.jpg" alt="" width="900" height="531" /><strong></strong></p>
<p style="text-align: center;"><strong>Circulation intérieure.</strong></p>
<p style="text-align: center;"><img class="size-full wp-image-76 aligncenter" title="Rez de chaussée." src="../Image/plan_rdc.jpg" alt="" width="426" height="279" /><br /><strong>Rez-de-Chaussée :
</strong>Accueil - Admission - Radiologie - Orthopédie - Ophtalmologie - Cardiologie - Neurologie - Angiologie.</p>
<p style="text-align: center;"><span style="color: #ffffff;">.</span></p>
<p style="text-align: center;"><img class="size-full wp-image-77 aligncenter" title="1er étage." src="../Image/plan_1etage.jpg" alt="" width="426" height="251" /></p>
<p style="text-align: center;"><strong>1er étage :</strong>
Médecine - Service d'USC - Soins externes - Plateau technique - Chirurgie ambulatoire.
Consultations : Urologie - Anesthésie - Gastro-entérologie - Chirurgie viscérale.</p>
<p style="text-align: center;"><span style="color: #ffffff;">.</span></p>
<p style="text-align: center;"><img class="size-full wp-image-78 aligncenter" title="2ème étage." src="../Image/plan_2etage.jpg" alt="" width="426" height="241" /><strong><br />2ème étage :
</strong>Services de chirurgie.</p>
<?php include("../include/pied.php");?>
</div>

</body>
</html>