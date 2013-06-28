<html>
<?php
//----------------------------------------------------------Ajout d'un pdf--------------------------------------------------//
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="divmiddle">
<?php
$idCat=$_POST["idCat"];
$ajoutArt=$_POST["ajoutArt"];

$nomOrigine = $_FILES['monfichierP']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = $elementsChemin['extension'];
$extensionsAutorisees = array("pdf");
if (!(in_array($extensionFichier, $extensionsAutorisees))) {
    echo "Le fichier n'a pas l'extension attendue";
} else {    
    // Copie dans le repertoire du script avec un nom
    $repertoireDestination = dirname(__FILE__).'/pdfProt/';
    $nomDestination = $nomOrigine;
    if (move_uploaded_file($_FILES["monfichierP"]["tmp_name"], 
                                     $repertoireDestination.$nomDestination)) {
        echo "Le fichier  ".$_FILES["monfichierP"]["name"].
                " a Ã©tÃ© dÃ©placÃ© vers le serveur";
				//envoi vers la base de donnÃ©e :
			$lien="../Application/HEM/pdfProt/".$nomDestination;
			$reqInsertLien="Insert into Hem values(null,'$ajoutArt','$lien',$idCat)";
			$resInsertLien=mysql_query($reqInsertLien);
			echo '<script language="Javascript">
				<!--
				var t=setTimeout("document.location.replace(\'GestionHEM.php\')", 2000);
			// -->
			// </script>';	
			echo " vous allez être redirigé vers la page de gestion, si la redirection est trop lente cliqué sur le lien ci-dessous";
			echo "<br /><h3><center><a href='GestionHEM.php'> Retour à  la page de gestion  </a></center></h3>";
    } else {
        echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                "Le dÃ©placement du fichier temporaire a Ã©chouÃ©".
                " vÃ©rifiez l'existence du rÃ©pertoire ".$repertoireDestination;
    }
}

?>
</div>
</body>
</html>
    
