<html>
<?php

include('../../include/connexion.php');
include ("../../style/style.css");
?>
<head>
 <style type="text/css">
  html {
	height:100%;
	width: 100%;
	max-width:100%;
	background-position:center;
	background-repeat:no-repeat;
	background-image:url(../../Image/fondsiteclinique.jpg);
	background-attachment:fixed;

};
</style>
</head>
<body>
<div id="divmiddle">
<?php
$nomOrigine = $_FILES['monfichier']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = $elementsChemin['extension'];
$extensionsAutorisees = array("pdf");
if (!(in_array($extensionFichier, $extensionsAutorisees))) {
    echo "Le fichier n'a pas l'extension attendue";
} else {    
    // Copie dans le repertoire du script avec un nom
    // incluant l'heure a la seconde pres 
    $repertoireDestination = dirname(__FILE__).'/pdfProt/';
    $nomDestination = $nomOrigine;
    if (move_uploaded_file($_FILES["monfichier"]["tmp_name"], 
                                     $repertoireDestination.$nomDestination)) {
        echo "Le fichier  ".$_FILES["monfichier"]["name"].
                " a été déplacé vers le serveur";
				//envoi vers la base de donnée :
			//	$lien=$repertoireDestination.$nomDestination;
				
    } else {
        echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                "Le déplacement du fichier temporaire a échoué".
                " vérifiez l'existence du répertoire ".$repertoireDestination;
    }
}

$lien=$repertoireDestination.$nomDestination;
?>
</div>
</body>
</html>
    