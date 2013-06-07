<?php 
  include ("../include/connexion.php");
 ?>
  <html><!-------------------------------------------------------Html------------------------------------------------->
  <head><!-------------------------------------------------------Head------------------------------------------------->
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
  <div id="affService" align="left">
  <?php
  $req = mysql_query("SELECT `idChambre` FROM `Chambre` where idService='ambu'") or die(mysql_error()); 
  ?>
  <br>
  <p style="font-size:20px"><u>Chambre :</u><select id="Chambre">
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
		while($maLigne2=mysql_fetch_array($res2))
		{
			echo "<tr>";
	    $idLigne=$maLigne2["idLigneContenu"];
		$contenu=$maLigne2["libContenu"];
		
		if((preg_match("/[$?]/",$contenu))) // si le contenu est une question alors :
		{
        
			echo("
			<td style='width:500';>$contenu</td>
			<td align='center' style='border-right-style:hidden'>Oui</td><td align='center' style='border-left-style:hidden'><input type='radio' name='$idPartie.$idLigne.$idType' value='Oui'></td><td align='center' style='border-right-style:hidden'>
			Non </td> <td align='center' style='border-left-style:hidden'><input type='radio' name='$idPartie.$idLigne.$idType' value='Non'></td>	
			</tr>");
     }
	 elseif((preg_match("/Remarques/",$contenu)))// si le contenu est une remarque alors :
	 {
		 echo "</table> <table border='1'>
		 <p align='left'>$contenu
		 <textarea name='idPartie.$idLigne.$idType'  style='width:250; height:50' ></textarea></p>";
	 }
	 else // sinon :
	 {
	echo "<td style='width:500;'>$contenu</td>
	<td align='center'><input type='radio' name='$idPartie.$idLigne.$idType' value='Tres satisfaisant'></td>
	<td align='center'><input type='radio' name='$idPartie.$idLigne.$idType'  value='Satisfaisant'></td>
	<td align='center'><input type='radio' name='$idPartie.$idLigne.$idType' value='Peu satisfaisant'></td>
	<td align='center'><input type='radio' name='$idPartie.$idLigne.$idType' value='Non satisfaisant'></td>	
	<td align='center'><input type='radio' name='$idPartie.$idLigne.$idType' checked value='Sans Avis'></td>	
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
  </body>
  </html>