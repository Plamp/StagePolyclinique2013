<?php
include "../include/connexion.php";
function AfficherVille($id)
{
$reponse = new xajaxResponse();//Création d'une instance de xajaxResponse pour traiter les réponses serveur

$ville='';// Initialisation de la variable $ville
//la selection des villes celon le code du department choisis
$req = mysql_query("SELECT `code_dept`,`nom` FROM `ville` where code_dept= ".$id." ORDER BY nom") or die(mysql_error()); 

$ville .='<select id="ville">'; // on commence la declaration de la liste des villes
$ville .='<option value="00">Selectionnez ville</option>';

  while($array = mysql_fetch_array($req))
{

               $ville .='<option value="'.$array['nom'].'">'.$array['nom'].'</option>';
               
}

$ville .='</select>';

$reponse = new xajaxResponse('ISO-8859-1');
$reponse->addAssign("affVille","innerHTML",$ville); // affichage du contenu de $ville (la liste des villes) dans le div affVille
return $reponse->getXML();
}

require("xajax.inc.php");
$xajax = new xajax(); //On initialise l'objet xajax
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("AfficherVille");
$xajax->processRequests();//Fonction qui va se charger de faire les requetes APRES AVOIR DECLARER NOS FONCTIONS
?>
<html>
<head>
<title>Document sans titre</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<?php $xajax->printJavascript(); /* Affiche le Javascript */?>
</head>

<body>
<?php
$req = mysql_query("SELECT `code`,`nom` FROM `departement` ORDER BY nom") or die(mysql_error()); 
?>
<select id="dept" onChange="xajax_AfficherVille(document.getElementById('dept').value);">
<option value="00">Selectionnez d&eacute;partement </option>
<?php
  while($array = mysql_fetch_array($req))
{
?>
                  <option value="<?php echo ($array['code']); ?>"><?php echo ($array['nom']."(".$array['code'].")"); ?></option>
                  <?php
}
?>
</select>
<div id="affVille"></div>
</body>
</html>
