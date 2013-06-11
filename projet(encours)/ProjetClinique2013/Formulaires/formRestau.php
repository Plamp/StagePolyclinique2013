<?php 
  include ("../include/connexion.php");
  //________________________________________________________________________________________________________________//
  //----------------------------Affichage de la liste "Chambre" sans rafraichissement-------------------------------//
  //________________________________________________________________________________________________________________//
  
  function AfficherChambre($id)
{
$reponse = new xajaxResponse();//Création d'une instance de xajaxResponse pour traiter les réponses serveur

$Chambre='';// Initialisation de la variable $Chambre
//la selection des Chambres selon le code du service choisis
$req = mysql_query("SELECT `idChambre` FROM `Chambre` where idService='".$id."' ORDER BY idChambre") or die(mysql_error()); 

$Chambre .='<p style="font-size:20px"><u>Chambre :</u><select name="idChambre" id="Chambre"></p>'; // on commence la declaration de la liste des Chambres
$Chambre .='<option value="00">Selectionnez votre Chambre</option>';

  while($array = mysql_fetch_array($req))
{

               $Chambre .='<option value="'.$array['idChambre'].'">'.$array['idChambre'].'</option>';
               
}

$Chambre .='</select><br>';

$reponse = new xajaxResponse('ISO-8859-1');
$reponse->addAssign("affChambre","innerHTML",$Chambre); // affichage du contenu de $Chambre (la liste des Chambres) dans la div affChambre
return $reponse->getXML();
}

require("xajax.inc.php");
$xajax = new xajax(); //On initialise l'objet xajax
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("AfficherChambre");
$xajax->processRequests();//Fonction qui va se charger de faire les requetes APRES AVOIR DECLARER NOS FONCTIONS
?>
<script language="javascript">
function selectionne(pValeur, pSelection,  pObjet) {
	//active l'objet pObjet du formulaire si la valeur sélectionnée (pSelection) est égale à la valeur attendue (pValeur)
	if (pSelection==pValeur) 
	{ formRAPPORT_VISITE.elements[pObjet].disabled=false; }
	else { formRAPPORT_VISITE.elements[pObjet].disabled=true; }
}
</script>
<?php

//____________________________________________________________________________________________________________________//
//----------------------------------------------Insertion dans la base------------------------------------------------//
//____________________________________________________________________________________________________________________//

if (isset($_POST["EnvoiRep"]) and $_POST["EnvoiRep"]="Envoyer")
{
	
//Récupération des données general du formulaire.
$idService=$_POST["idService"];
$dateSaisie=$_POST["dateToday"];
$dateEntree=$_POST["dateArrive"];
$idChambre=$_POST["idChambre"];
$idType=$_POST["idType"];

// insertion des données d'affichage.
$reqInsertAffi="Insert into Affichage values(null,'$dateEntree','$dateSaisie','$idService','$idChambre','$idType')";
$resInsertAffi=mysql_query($reqInsertAffi);

//Recupération du n° de questionnaire
$reqNoQuest="Select noQuestionnaire from Affichage";
$resNoQuest=mysql_query($reqNoQuest);
while($LigneAffi=mysql_fetch_array($resNoQuest))
{
	$noQuestionnaire=$LigneAffi["noQuestionnaire"];
}
//récupération des information rentrée dans le formulaire automatisé.
$reqSelectPartie="Select * from Partie where idType='$idType'";
$resSelectPartie=mysql_query($reqSelectPartie);

//boucle1
while($LignePartie=mysql_fetch_array($resSelectPartie))
{
$idPartie=$LignePartie["idPartie"];

$reqSelectContenu="select idLigneContenu from ContenuPartie where idPartie=$idPartie and  idType='$idType'";
$resSelectContenu=mysql_query($reqSelectContenu);

//boucle2
while($LigneContenu=mysql_fetch_array($resSelectContenu))
{
$idLigneContenu=$LigneContenu["idLigneContenu"];
$contenu=$idPartie.$idLigneContenu.$idType;
//recupération des valeurs
$libContenu=$_POST[$contenu];
$libContenu=sprintf($libContenu);
$reqInsertSati="insert into Satisfaction value('$noQuestionnaire','$idPartie','$idType','$idLigneContenu','$libContenu')";
$resInsertSati=mysql_query($reqInsertSati);

//fin boucle 2
}
//fin boucle1
}

//----------------------------------------------------Fin d'insertion--------------------------------------------------//

//____________________________________________________________________________________________________________________//
//------------------------------------------------Envoi de la reponse-------------------------------------------------//
//____________________________________________________________________________________________________________________//

$headers ='From: "Jesus"<jesus_is_back@gmail.com>'."\n"; 
     $headers .='Content-Type: text/html; charset="UTF8"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 

//debut du message
$message="<html><body><fieldset style='background :#AADBE2;
	font-family:tahoma,arial,sans-serif;'>";
//-------------------------------------------------------------------------------//
$reqNomService="Select libService from Service where idService='$idService'";
$resNomService=mysql_query($reqNomService);
while($LigneNom=mysql_fetch_array($resNomService))
{
	$libService=$LigneNom["libService"];
}
//------------------------------------------------------------------------------//
$message.="<table border=0><tr>";
$message.="<td>Service :</td><td><input type='text' name=idService value='$libService' disabled/></td></tr> ";
$message.="<tr><td>Chambre :</td><td><input type='text' name='idChambre' value='$idChambre' disabled/></td></tr>";
$message.="<tr><td>Date d'entrée :</td><td><input type='text' name='dateEntree' disabled value='$dateSaisie'></td></tr>";
//------------------------------------------------------------------------------//
$req="select * from ContenuPartie where idPartie='1' and idType='repas'";
$res=mysql_query($req);
while($maLigne=mysql_fetch_array($res))
{
	
	    $idLigne=$maLigne["idLigneContenu"];
		$contenu=$maLigne["libContenu"];
		$idPartie=$maLigne["idPartie"];
		$idType=$maLigne["idType"];
		$reqRechercheSati="select * from satisfaction where	idPartie=$idPartie and idLigneContenu=$idLigne and noQuestionnaire=$noQuestionnaire";
		$resRechercheSati=mysql_query($reqRechercheSati);
		while($ligneSati=mysql_fetch_array($resRechercheSati))
		{
			$message.="<tr><td>$contenu</td>";
			$reponse=$ligneSati["libSatisfaction"];
			if ($reponse=="Oui")
			{
$message.="<td>Oui<input type='radio' disabled name='$idPartie$idLigne$idType' checked value='Oui'></td>";
$message.="<td>non<input type='radio' disabled name='$idPartie$idLigne$idType' value='non'></td>	";
			}
			else
			{
$message.="<td>Oui<input type='radio' disabled name='$idPartie$idLigne$idType' value='Oui'></td>";
$message.="<td>non<input type='radio' disabled name='$idPartie$idLigne$idType'checked value='non'></td>	";
			}
		}
$message.="</tr>";
			}
		$message.="</table>";
//-----------------------------------------------------------------------------//




$message.="</fieldset></body></html>";
// fin message

     if(mail('melindrae@gmail.com', 'Jesus à repondu au formulaire '.$idType, $message, $headers)) 
     { 
          echo 'Le message a bien été envoyé'; 
     } 
     else 
     { 
          echo 'Le message n\'a pu être envoyé'; 
     } 
//fin if isset
}


//------------------------------------------------------Fin d'envoi---------------------------------------------------//
?>
<html>
<!-------------------------------------------------------Html------------------------------------------------->
<head>
<!-------------------------------------------------------Head------------------------------------------------->
<?php 
$xajax->printJavascript(); /* Affiche le Javascript */
  include ("../include/entete.php");
  include ("../style/style.css");
  ?>
<title>Questionnaire de satisfaction - prestation de restauration</title>
</head>
<!-----------------------------------------------------/Head------------------------------------------------->

<body>
<!-------------------------------------------------------Body-------------------------------------------------> 
<br>
<!-------------------------------------------------------------titre------------------------------------------------>
<fieldset align="center" style="border-color:#000">
  Questionnaire de satisfaction - prestation de restauration
</fieldset>
<!----------------------------------------------------------listeService-------------------------------------------->
<form name="FormulaireAuto" method="POST" action="">
  <div id="affService" align="left">
    <?php
  $req = mysql_query("SELECT `idService`,`libService` FROM `Service` ORDER BY idService") or die(mysql_error()); 
  ?>
    <br>
    <p style="font-size:20px"><u>service :</u>
      <select name="idService" id="Service" onChange="xajax_AfficherChambre(document.getElementById('Service').value);">
        <option value="00">Selectionnez votre Service </option>
        <?php
	while($array = mysql_fetch_array($req))
  {
  ?>
        <option value="<?php echo ($array['idService']); ?>"><?php echo ($array['libService']."(".$array['idService'].")"); ?></option>
        <?php
  }
  ?>
      </select>
    </p>
  </div>
  <br>
  <!--------------------------------------------------------finListeService-----------------------------------------> 
  <!---------------------------------------------------------ListeChambre------------------------------------------->
  <div id="affChambre" align="left"></div>
  <!--------------------------------------------------------finListeChambre----------------------------------------->
  <?php
  $date=date("Y-m-d");// currentDate
  ?>
  <input type="hidden" name="dateToday" value="<?=$date?>"/>
  <!-- date du jour-->
  <p align="left">Date d'arrivé dans le service :
    <input type="date" name="dateArrive"/>
  </p>
  <?php
  //______________________________________________________________________________________________________________________//
  //-------------------------------------------codage spécifique: premier tableau-----------------------------------------//
  //______________________________________________________________________________________________________________________//
  ?>
  <table border="0">
  <?php
  $req="select * from ContenuPartie where idPartie='1' and idType='repas'";
  $res=mysql_query($req);
		while($maLigne=mysql_fetch_array($res))
		{
		echo "<tr>";
	    $idLigne=$maLigne["idLigneContenu"];
		$contenu=$maLigne["libContenu"];
		$idPartie=$maLigne["idPartie"];
		$idType=$maLigne["idType"];
		echo("
			<td>$contenu</td>
			<td>Oui<input type='radio' name='$idPartie$idLigne$idType' value='Oui'></td><td>
			Non<input type='radio' name='$idPartie$idLigne$idType' value='Non'></td>	
			</tr>"
			);
			
		}
		echo "</table>";
 
  //______________________________________________________________________________________________________________________//
  //--------------------------------------------Gestion du formulaire automatisé------------------------------------------//
  //______________________________________________________________________________________________________________________//
  $type="repas"; // seule valeur à changer pour afficher les informations des formulaire.
  $req1="select * from Partie where idType='$type' and idPartie!=1";
  $res1=mysql_query($req1);
  
  //_____________________________________________________________________________________________________________________//
  //-----------------------------------------------Gestion des titres----------------------------------------------------//
  //_____________________________________________________________________________________________________________________//
  while($maLigne1=mysql_fetch_array($res1))
  {
	  echo "<br>";
  $idPartie=$maLigne1["idPartie"];
  $libPartie=$maLigne1["libPartie"];
  $idType=$maLigne1["idType"];
  echo "<p align='left'><b>$libPartie</b></p>";
 echo "<input type='hidden' name='idType' value=$idType>";
  
  ?>
  <fieldset style="border-style:solid;border-color:#000;">
    <table border="1">
      
        <th style="border-left:hidden">Veuillez indiquer votre satisfaction sur:</th>
        <th>Très satisfaisant</th>
        <th>Satisfaisant</th>
        <th>Peu satisfaisant</th>
        <th>Non satisfaisant</th>
        <th>Sans Avis</th>
        <?php
  //_____________________________________________________________________________________________________________________//
  //-----------------------------------------------Gestion des contenus--------------------------------------------------//
  //_____________________________________________________________________________________________________________________//
 
  $req2="select * from ContenuPartie where idPartie='$idPartie' and idType='$type'";
  $res2=mysql_query($req2);
		while($maLigne2=mysql_fetch_array($res2))
		{
			echo "<tr>";
	    $idLigne=$maLigne2["idLigneContenu"];
		$contenu=$maLigne2["libContenu"];
		
		if((preg_match("/[$?]/",$contenu))) // si le contenu est une question alors :
		{
        
			echo("
			<td>$contenu</td>
			<td align='center'>Oui<input type='radio' name='$idPartie$idLigne$idType' value='Oui'></td><td align='center'>
			non<input type='radio' name='$idPartie$idLigne$idType' value='non'></td>	
			</tr>");
     }
	 elseif((preg_match("/[$:]/",$contenu)))// si le contenu est une remarque alors :
	 {
		 echo "</table> <table border='1'>
		 <p align='left'>$contenu
		 <textarea name='$idPartie$idLigne$idType'  style='width:250; height:50' ></textarea></p>";
	 }
	 else // sinon :
	 {
	echo "<td style='width:500;'>$contenu</td>
	<td align='center'><input type='radio' name='$idPartie$idLigne$idType' value='Tres satisfaisant'></td>
	<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  value='Satisfaisant'></td>
	<td align='center'><input type='radio' name='$idPartie$idLigne$idType' value='Peu satisfaisant'></td>
	<td align='center'><input type='radio' name='$idPartie$idLigne$idType' value='Non satisfaisant'></td>	
	<td align='center'><input type='radio' name='$idPartie$idLigne$idType' checked value='Sans Avis'></td>	
	"; 
	 }
		}
	?>
    </table>
  </fieldset>
  <br>
  <?php
  }
  
?>
  <p align="center"><u>Envoyer vos réponses</u>
    <input type="submit" name="EnvoiRep" value="Envoyer">
  </p>
</form>
</body>
</html>
