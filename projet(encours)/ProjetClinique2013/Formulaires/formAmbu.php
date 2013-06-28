<?php 
  include ("../include/connexion.php");
//____________________________________________________________________________________________________________________//
//----------------------------------------------Insertion dans la base------------------------------------------------//
//____________________________________________________________________________________________________________________//
if (isset($_POST["EnvoiRep"]) and $_POST["EnvoiRep"]="Envoyer")
{
	//Récupération des données general du formulaire.
	$idService="ambu";
	$dateSaisie=$_POST["dateToday"];
	$dateEntree=$_POST["dateArrive"];
	$idChambre=$_POST["idChambre"];
	$idType=$_POST["idType"];
	// insertion des données d'affichage.
	$reqInsertAffi="Insert into Affichage values(null,'$dateEntree','$dateSaisie','$idService','$idChambre','$idType')";
	$resInsertAffi=mysql_query($reqInsertAffi);
	//Recupération du n° de questionnaire
	$reqNoQuest="Select max(noQuestionnaire) as noQuestionnaire from Affichage";
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
	  $headers ='From: "Root"<Pasbesoindadresse@root.fr>'."\n"; 
	  $headers .='Content-Type: text/html; charset="UTF-8"'."\n"; 
	  $headers .='Content-Transfer-Encoding: 8bit'; 
	   $reqCountNo="Select count(noQuestionnaire) as no,idType from Affichage where idType='$idType' group by idType";
		 $resCountNo=mysql_query($reqCountNo);
		 while($maLigne3=mysql_fetch_array($resCountNo))
		 {
			 $noQuestionnaireType=$maLigne3["no"];
		 }
	  //debut du message
	  $message="<html><head>";
	  $message.="<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
	  $message.="<body><fieldset style='background :#DCDEED;font-family:tahoma,arial,sans-serif;font-size:0.85em;'>";
	  //-------------------------------------------------------------------------------//
	  $reqNomService="Select libService from Service where idService='$idService'";
	  $resNomService=mysql_query($reqNomService);
	  while($LigneNom=mysql_fetch_array($resNomService))
	  	{
	    $libService=$LigneNom["libService"];
	  	}
	  //------------------------------------------------------------------------------//
	  $message.="<table border=0><tr>";
	  $message.="<td style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>Chambre :</td><td><input type='text' name='idChambre' value='$idChambre' size='5' disabled/></td>";
	  $message.="<td style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>Date d'entr&eacute;e :</td><td><input type='text' name='dateEntree' size='11'disabled value='$dateSaisie'></td></tr></table>";
	 
		//______________________________________________________________________________________________________________________//
		//--------------------------------------------Gestion du formulaire automatisé------------------------------------------//
		//______________________________________________________________________________________________________________________//
		$reqSelect="select * from Partie where idType='$idType'";
		$resSelect=mysql_query($reqSelect);
		//boucle5
			while($maLigne1=mysql_fetch_array($resSelect))
			{
		   $idPartie=$maLigne1["idPartie"];
		   $libPartie=$maLigne1["libPartie"];
		   $idType=$maLigne1["idType"];
		   //saut de page avant le contenu de brancardage
		   if ($idPartie ==7)
		   {
			   $message.="<br />";
			   $message.="<br />";
			   $message.="<br />";
			   $message.="<br />";
			   $message.="<br />";
			   $message.="<br />";
			   $message.="<br />";
			   $message.="<br />";
			   $message.="<br />";
		   }
		      //codage sp�cifique: gestion de la partie V.
  			if ($idPartie ==5)
 				 {
 				 $message.="<div align='left'><b>$libPartie</b></span>";
  					}
  					else
  					{
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
					  if($i%2==1)
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
						$message.="<td  style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>$contenu</td>";
						if ($reponse=="Oui")
							{
							$message.="<td align='center' style='border-style:hidden'>Oui</td>
							<td align='center' style='border-style:hidden'><input type='radio'checked name='$idPartie$idLigne$idType' value='Oui'></td>";
							$message.="<td align='center' style='border-style:hidden'>
			Non </td> <td align='center' style='border-style:hidden'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Non'></td>	";
							  echo"</tr>";

							}
					    else
							{
	$message.="<td align='center' style='border-style:hidden'>Oui</td>
							<td align='center' style='border-style:hidden'><input type='radio'disabled name='$idPartie$idLigne$idType' value='Oui'></td>";
							$message.="<td align='center' style='border-style:hidden'>
			Non </td> <td align='center' style='border-style:hidden'><input type='radio'checked name='$idPartie$idLigne$idType' value='Non'></td>	";
							  echo"</tr>";

							}
						}
						elseif((preg_match("/Remarques/",$contenu)))// si le contenu est une remarque alors :

						{
							$message.="</table> ";
							$message.="<p align='left'>$contenu";
							$message.="<textarea name='$idPartie$idLigne$idType' style='width:400px;color:#000000; height:35px;font-family:tahoma, arial,sans-serif; font-size:0.85em;' disabled >$reponse</textarea></p>";
						}
						else // sinon :
						{
							$message.="<td  style='font-family:tahoma,arial,sans-serif;font-size:0.9em'>$contenu</td>";
							if ($reponse=="Tres satisfaisant")
								{
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' checked value='Tres satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  disabled value='Satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Peu satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Non satisfaisant'></td>";	
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Sans Avis'></td>";	
							  echo"</tr>";

								}
							elseif ($reponse=="Satisfaisant")
								{
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Tres satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  checked value='Satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Peu satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Non satisfaisant'></td>";	
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Sans Avis'></td>";	
							  echo"</tr>";

								}
							elseif ($reponse=="Peu satisfaisant")
								{
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Tres satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  disabled value='Satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'checked value='Peu satisfaisant'></td>";
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Non satisfaisant'></td>";	
								$message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Sans Avis'></td>";	
							        echo"</tr>";

								}
							elseif ($reponse=="Non satisfaisant")
								  {
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Tres satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  disabled value='Satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Peu satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' checked value='Non satisfaisant'></td>";	
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Sans Avis'></td>";	
								   echo"</tr>";

								  }
							 elseif($reponse=="Sans Avis")
								 {
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Tres satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'  disabled value='Satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType'disabled value='Peu satisfaisant'></td>";
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' disabled value='Non satisfaisant'></td>";	
								 $message.="<td align='center'><input type='radio' name='$idPartie$idLigne$idType' checked value='Sans Avis'></td>";	
								  echo"</tr>";

								 }
			
						}

				  //fin boucle 7
				  }
				  //fin codage sp�
				}
				//fin boucle 6
				}	
				if ($idPartie !=5)
				{	
				  $message.="</table>";
				  $message.="</fieldset>";
				}
				  //$message.="<br>";	
		//fin boucle5
		}
		
$message.="</fieldset></body></html>";
 // fin message
	  
		if( mail('froux@clinalpsud.com', utf8_encode("Questionnaire de satisfaction - Ambulatoire num&eacute;ro ").$noQuestionnaireType, $message, $headers)) 
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
	  //fin if isset
	  }


 ?>
  <html><!-------------------------------------------------------Html------------------------------------------------->
  <head><!-------------------------------------------------------Head------------------------------------------------->
<meta http-equiv="Content-Type" content="text/html;  charset='UTF8'" />
<?php 
  include ("../include/entete.php");
  include ("../style/style.css");
  ?>
  <title>QUESTIONNAIRE DE SATISFACTION - SERVICE AMBULATOIRE</title>
  </head><!-----------------------------------------------------/Head------------------------------------------------->
  
  <body><!-------------------------------------------------------Body------------------------------------------------->
  <br>
  <!-------------------------------------------------------------titre------------------------------------------------>
  <fieldset align="center" style="border-color:#000">
QUESTIONNAIRE DE SATISFACTION - SERVICE AMBULATOIRE
  </fieldset>
  <!----------------------------------------------------------listeService-------------------------------------------->
  <form name="FormulaireAuto" method="POST" action="">
  <div id="affService" align="left">
  <?php
  $req = mysql_query("SELECT `idChambre` FROM `Chambre` where idService='ambu'") or die(mysql_error()); 
  ?>
  <br>
  <p><u>Chambre :</u><select name="idChambre" id="Chambre">
  <option value="00">Selectionnez votre Chambre </option>
  
  <?php
	while($array = mysql_fetch_array($req))
  {
  ?>
					<option value="<?php echo ($array['idChambre']); ?>"><?php echo ($array['idChambre']); ?></option>
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
  <input type="hidden" name="dateToday" value="<?=$date?>"/><!-- date du jour-->
  <p align="left">Date d'arrivé dans le service :<input type="date" name="dateArrive"/>
  </p>
  <?php
  
  //______________________________________________________________________________________________________________________//
  //--------------------------------------------Gestion du formulaire automatisé------------------------------------------//
  //______________________________________________________________________________________________________________________//
  $type="ambu"; // seule valeur à changer pour afficher les informations des formulaires.
  ?>
    <input type="hidden" name="idType" value="<?=$type?>"/>
  <?php
  $req1="select * from Partie where idType='$type'";
  $res1=mysql_query($req1);
  
  //_____________________________________________________________________________________________________________________//
  //-----------------------------------------------Gestion des titres----------------------------------------------------//
  //_____________________________________________________________________________________________________________________//
  while($maLigne1=mysql_fetch_array($res1))
  {
	 
  $idPartie=$maLigne1["idPartie"];
  $libPartie=$maLigne1["libPartie"];
  $idType=$maLigne1["idType"];
    //codage spécifique: gestion de la partie V.
  if ($idPartie ==5)
  {
  echo "<div align='left'><b>$libPartie</b></span>";
  }
  else
  {
	  echo "<br>";
  echo "<p align='left'><b>$libPartie</b></p>";
 

  ?>
  <fieldset style="border-style:solid;border-color:#000;">
 <table border="1">
  <th style="border-left:hidden">Veuillez indiquer votre satisfaction sur:</th><th>Très satisfaisant</th><th>Satisfaisant</th><th>Peu satisfaisant</th><th>Non satisfaisant</th><th>Sans Avis</th>
 
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
				echo "<tr style='background-color:#9999FF'>";
			}
	    $idLigne=$maLigne2["idLigneContenu"];
		$contenu=$maLigne2["libContenu"];
		
		if((preg_match("/[$?]/",$contenu))) // si le contenu est une question alors :
		{
        
			echo("
			<td style='width:500';>$contenu</td>
			<td align='center' style='border-style:hidden'>Oui</td><td align='center' style='border-style:hidden'><input type='radio' name='$idPartie$idLigne$idType' value='Oui'></td>
			<td align='center' style='border-style:hidden'>
			Non </td> <td align='center' style='border-style:hidden'><input type='radio' name='$idPartie$idLigne$idType' value='Non'></td>	
			</tr>");
     }
	 elseif((preg_match("/Remarques/",$contenu)))// si le contenu est une remarque alors :
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
  }
?>
 <p align="center"><u>Envoyer vos réponses</u>
    <input type="submit" name="EnvoiRep" value="Envoyer">
  </p>
</form>
  </body>
  </html>
