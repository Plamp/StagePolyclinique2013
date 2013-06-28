<?php
  include ("../include/connexion.php");
  //________________________________________________________________________________________________________________//
  //----------------------------Affichage de la liste "Chambre" sans rafraichissement-------------------------------//
  //________________________________________________________________________________________________________________//
  
  function AfficherChambre($id)
{
$reponse = new xajaxResponse();//Cr�ation d'une instance de xajaxResponse pour traiter les r�ponses serveur

$Chambre='';// Initialisation de la variable $Chambre
//la selection des Chambres selon le code du service choisis
$req = mysql_query("SELECT `idChambre` FROM `Chambre` where idService='".$id."' ORDER BY idChambre") or die(mysql_error()); 

$Chambre .='<p><u>Chambre :</u><select name="idChambre" id="Chambre"></p>'; // on commence la declaration de la liste des Chambres
$Chambre .='<option value="00">Selectionnez votre Chambre</option>';

  while($array = mysql_fetch_array($req))
{

               $Chambre .='<option value="'.$array['idChambre'].'">'.$array['idChambre'].'</option>';
               
}

$Chambre .='</select><br>';

$reponse = new xajaxResponse('UTF-8');
$reponse->addAssign("affChambre","innerHTML",$Chambre); // affichage du contenu de $Chambre (la liste des Chambres) dans la div affChambre
return $reponse->getXML();
}

require("xajax.inc.php");
$xajax = new xajax(); //On initialise l'objet xajax
$xajax->setCharEncoding('UTF-8');
//$xajax->decodeUTF8InputOn();
$xajax->registerFunction("AfficherChambre");
$xajax->processRequests();//Fonction qui va se charger de faire les requetes APRES AVOIR DECLARER NOS FONCTIONS
?>
<script language="javascript">
function selectionne(pValeur, pSelection,  pObjet) {
	//active l'objet pObjet du formulaire si la valeur s�lectionn�e (pSelection) est �gale � la valeur attendue (pValeur)
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
	//Recup�ration du n° de questionnaire
	$reqNoQuest="Select max(noQuestionnaire) as noQuestionnaire from Affichage";
	$resNoQuest=mysql_query($reqNoQuest);
	while($LigneAffi=mysql_fetch_array($resNoQuest))
		{
		$noQuestionnaire=$LigneAffi["noQuestionnaire"];
		}
	//r�cup�ration des information rentrée dans le formulaire automatis�.
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
	  $headers ='From: "SiteWeb"<siteweb@clinalpsud.com>'."\n"; 
	  $headers .='Content-type: text/html; charset=UTF-8'."\n"; 
	  $headers .='Content-Transfer-Encoding: 8bit'; 
	   $reqCountNo="Select count(noQuestionnaire) as no,idType from Affichage where idType='$idType' group by idType";
		 $resCountNo=mysql_query($reqCountNo);
		 while($maLigne3=mysql_fetch_array($resCountNo))
		 {
			 $noQuestionnaireType=$maLigne3["no"];
		 }
	  //debut du message
	  $message="<html><body><fieldset style='background :#DCDEED;font-family:tahoma,arial,sans-serif;font-size:0.85em;'>";
	 //   $message.="<br />";
	//	  $message.="<br />";
	  //-------------------------------------------------------------------------------//
	  $reqNomService="Select libService from Service where idService='$idService'";
	  $resNomService=mysql_query($reqNomService);
	  while($LigneNom=mysql_fetch_array($resNomService))
	  	{
	    $libService=$LigneNom["libService"];
	  	}
	  //------------------------------------------------------------------------------//
	  $message.="<table border=0><tr>";
	  $message.="<td style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>Service :</td><td><input type='text' name=idService size='10' value='$libService' disabled/></td> ";
	  $message.="<td style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>Chambre :</td><td><input type='text' name='idChambre' value='$idChambre' size='5' disabled/></td>";
	  $message.="<td style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>Date d'entr&eacute;e :</td><td><input type='text' name='dateEntree' size='11'disabled value='$dateSaisie'></td></tr></table>";
	  //______________________________________________________________________________________________________________________//
	  //----------------------------------------------Codage spécifique:premier menu------------------------------------------//
	  //______________________________________________________________________________________________________________________//
	  $req="select * from ContenuPartie where idPartie='1' and idType='repas'";
	  $res=mysql_query($req);
	  //$message.="<br />";
	 // $message.="<br />";
	  $message.="<table border='0' style='font-family:tahoma,arial,sans-serif;font-size:0.85em;'>";
	  //boucle3
	  while($maLigne=mysql_fetch_array($res))
	  	{
		$idLigne=$maLigne["idLigneContenu"];
		$contenu=$maLigne["libContenu"];
		$idPartie=$maLigne["idPartie"];
		$idType=$maLigne["idType"];
		$reqRechercheSati="select * from Satisfaction where idPartie=$idPartie and idLigneContenu=$idLigne and noQuestionnaire=$noQuestionnaire";
		$resRechercheSati=mysql_query($reqRechercheSati);
		//boucle4
		while($ligneSati=mysql_fetch_array($resRechercheSati))
			{
				$message.="<tr><td>$contenu</td>";
		 	$reponse=$ligneSati["libSatisfaction"];
			if ($reponse=="Oui")
				{
				$message.="<td>Oui<input type='radio'  name='$idPartie$idLigne$idType' checked value='Oui'></td>";
				$message.="<td>Non<input type='radio' disabled name='$idPartie$idLigne$idType' value='Non'></td>";
				}
			else
				{
				$message.="<td>Oui<input type='radio' disabled name='$idPartie$idLigne$idType' value='Oui'></td>";
				$message.="<td>Non<input type='radio' name='$idPartie$idLigne$idType'checked value='Non'></td>";
				 }
			//fin boucle4
			}
	  $message.="</tr>";
	  //fin boucle3
	  }
			  $message.="</table>";
		//______________________________________________________________________________________________________________________//
		//--------------------------------------------Gestion du formulaire automatisé------------------------------------------//
		//______________________________________________________________________________________________________________________//
		$reqSelect="select * from Partie where idType='$idType' and idPartie!=1";
		$resSelect=mysql_query($reqSelect);
		//boucle5
			while($maLigne1=mysql_fetch_array($resSelect))
		{
		   $idPartie=$maLigne1["idPartie"];
		   $libPartie=$maLigne1["libPartie"];
		   $idType=$maLigne1["idType"];
		   $message.="<div style='align=left;font-size:0.8em;'><b>$libPartie</b></div>";
		   $message.="<input type='hidden' name='idType' value=$idType>";	
		   $message.='<fieldset style="border-style:solid;border-color:#000;">';
		   $message.='<table border="1" style="width:600px;font-family:tahoma,arial,sans-serif;font-size:0.9em;">';
		   $message.='<th style="border-left:hidden">Questions</th>';
		   $message.='<th>Tr&egrave;s satisfaisant</th>';
		   $message.='<th>Satisfaisant</th>';
		   $message.='<th>Peu satisfaisant</th>';
		   $message.='<th>Non satisfaisant</th>';
		   $message.='<th>Sans Avis</th>';
		   $i=0;
		//_____________________________________________________________________________________________________________________//
		//-----------------------------------------------Gestion des contenus--------------------------------------------------//
		//_____________________________________________________________________________________________________________________//
			$req2="select * from ContenuPartie where idPartie='$idPartie' and idType='$idType'";
			$res2=mysql_query($req2);
			//boucle 6
			while($maLigne2=mysql_fetch_array($res2))
				{
				$idLigne=$maLigne2["idLigneContenu"];
				$contenu=$maLigne2["libContenu"];
				$reqSelectSatisAuto="Select  * from Satisfaction where idPartie=$idPartie and idLigneContenu=$idLigne and noQuestionnaire=$noQuestionnaire";
				$resSelectSatisAuto=mysql_query($reqSelectSatisAuto);
				  //boucle 7
				  while($SelectSatisAuto=mysql_fetch_array($resSelectSatisAuto))
				  {
					  $i=$i+1;
					  if ($i%2==1)
					  {
					  $message.="<tr style='background-color:#CCCCFF'>";
					  }
					  else
					  {
						  $message.="<tr style='background-color:#9999FF'>";
					  }
					  $reponse=$SelectSatisAuto["libSatisfaction"];
				   	  if((preg_match("/[$?]/",$contenu))) // si le contenu est une question alors :
						{
						$message.="<td  style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>". utf8_encode('$contenu')."</td>";
						if ($reponse=="Oui")
							{
							$message.="<td>Oui<input type='radio'  name='$idPartie$idLigne$idType' checked value='Oui'></td>";
							$message.="<td>Non<input type='radio' disabled name='$idPartie$idLigne$idType' value='Non'></td>";
							}
					    else
							{
							$message.="<td>Oui<input type='radio' disabled name='$idPartie$idLigne$idType' value='Oui'></td>";
							$message.="<td>Non<input type='radio' name='$idPartie$idLigne$idType'checked value='Non'></td>";
							}
						}
						elseif((preg_match("/[$:]/",$contenu)))// si le contenu est une remarque alors :

						{
							$message.="</table> ";
							$message.="<p align='left'>". $contenu;
							$message.="<textarea name='$idPartie$idLigne$idType'  style='width:400px;color:#000000;height:35px;font-family:tahoma,arial,sans-serif;font-size:0.85em;' disabled >$reponse</textarea></p>";
						}
						else // sinon :
						{
							$message.="<td  style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>".$contenu."</td>";
							if ($reponse=="Tres satisfaisant")
								{
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' checked value='Tres satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  disabled value='Satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Peu satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Non satisfaisant'></td>";	
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Sans Avis'></td>";	
								}
							elseif ($reponse=="Satisfaisant")
								{
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Tres satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  checked value='Satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Peu satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Non satisfaisant'></td>";	
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Sans Avis'></td>";	
								}
							elseif ($reponse=="Peu satisfaisant")
								{
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Tres satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  disabled value='Satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'checked value='Peu satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Non satisfaisant'></td>";	
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Sans Avis'></td>";	
								 }
							elseif ($reponse=="Non satisfaisant")
								  {
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Tres satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  disabled value='Satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Peu satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' checked value='Non satisfaisant'></td>";	
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Sans Avis'></td>";	
								  }
							 elseif($reponse=="Sans Avis")
								 {
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Tres satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  disabled value='Satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Peu satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Non satisfaisant'></td>";	
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' checked value='Sans Avis'></td>";	
								 }
						}
				  //fin boucle 7
				  }
							
				//fin boucle 6
				}		
				  $message.="</table>";
				  $message.="</fieldset>";
				  //$message.="<br>";	
		//fin boucle5
		}
		
$message.="</fieldset></body></html>";
 // fin message
	  
		  if (mail('froux@clinalpsud.com', 'Questionnaire de satisfaction - restauration num&eacute;ro '.$noQuestionnaireType, $message, $headers))
		  {
			echo '<script language="Javascript">
			<!--
			document.location.replace("../index.php");
		// -->
		// // </script>';  
		  }
		  else
		  {
			  echo "<h3>Veuillez saisir tout les champs SVP</h3>";
		  }
		  // mail('plampson@clinalpsud.com', 
		//	   utf8_encode("Questionnaire de satisfaction - prestation de restauration n�") .$noQuestionnaireType, $message, $headers); 
		 
	  //fin if isset
	  }

?>
<html>
<!-------------------------------------------------------Html------------------------------------------------->
<head>
<!-------------------------------------------------------Head------------------------------------------------->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
    <p><u>service :</u>
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
  <p align="left"><?php echo utf8_encode("Date d'arriv�  dans le service :")?>
    <input type="date" name="dateArrive"/>
  </p>
  <?php
  //______________________________________________________________________________________________________________________//
  //-------------------------------------------codage sp�cifique: premier tableau-----------------------------------------//
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
  $type="repas"; // seule valeur � changer pour afficher les informations des formulaire.
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
    <th><?php echo utf8_encode("Tr�s satisfaisant")?></th>
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
	$i=0;
		while($maLigne2=mysql_fetch_array($res2))
		{
			$i=$i+1;
			if($i%2==1)
			{
				echo "<tr style='background-color:#CCCCFF'>";
			}
			else
			{
				echo"<tr style='background-color:#9999FF'>";
			}
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
		 		<textarea name='$idPartie$idLigne$idType'  style='height:50' ></textarea></p>";
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
  </fieldset><?php
  }?>
  <br>
  <p align="center"><u><?php echo utf8_encode("Envoyer vos r�ponses")?></u>
    <input type="submit" name="EnvoiRep" value="Envoyer">
  </p>
</form>
</body>
</html>
