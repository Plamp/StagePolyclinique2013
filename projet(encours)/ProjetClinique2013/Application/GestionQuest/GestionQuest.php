<?php
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestion des questionnaires</title>
<div id="divmiddle">
<?php
include ("../../include/connexion.php");
include ("../../style/style.css");
  ?>
  <style type="text/css">
  html {
	height:100%;
	width: 100%;
	max-width:100%;
	background-position:center;
	background-repeat:no-repeat;
	background-image:url(../../Image/fondsiteclinique.jpg);
	background-attachment:fixed;

}
</style>
</head>
  <body>

<?php
if(($_SESSION["login"]=="plampson" && $_SESSION["mdp"]=="Clinalp01!") or ($_SESSION["login"]=="froux" && $_SESSION["mdp"]=="Clinalp02!"))
{
	$login=$_SESSION["login"];
	$mdp=$_SESSION["mdp"];
	?>
    <h2><center><b> Gestion des questionnaires: </b></center></h2><br />
<center><table border=1>

<?php
	//----------------------------------------------------------Activer le questionnaire-------------------------------------------------------//
	if (isset($_POST["EtatA"])=="Activer")
	{
		$idType=$_POST["idType"];
		$reqActive="update TypeQuestionnaire set active=1 where idType='$idType'";
		$resActive=mysql_query($reqActive);
	}
	     //--------------------------------------------------------Desactiver le questionnaire-------------------------------------------------------//
        if (isset($_POST["EtatD"])=="Desactiver")
        {
                $idType=$_POST["idType"];
                $reqActive="update TypeQuestionnaire set active=FALSE where idType='$idType'";
		$resActive=mysql_query($reqActive);
	        }
      
	//-----------------------------------------------------------------Affichage---------------------------------------------------------------//
	$reqSelectQuest="Select idType,libType,active from TypeQuestionnaire";
	$resSelectQuest=mysql_query($reqSelectQuest);
	$i=0;
	while($ligneQuest=mysql_fetch_array($resSelectQuest))
	{
		$lib=$ligneQuest["libType"];
		$active=$ligneQuest["active"];
		$idType=$ligneQuest["idType"];

		$i=$i+1;
		echo "<tr><form action='' method='POST'>";
		echo "<input type='hidden' name='idType' value='$idType'/>";
		if($i%2==1)
		{
			echo "<td style='background-color:#999'>".$lib."</td>";
			if ($active==true)
			{
				echo "<td style='background-color:#999'>Activ&eacute;</td><td style='background-color:#999'><input type='submit' name='EtatD' value='Desactiver'></td>";
			}
			else
			{
				echo "<td style='background-color:#999'>Desactiv&eacute;</td><td style='background-color:#999'><input type='submit' name='EtatA' value='Activer'></td>";
			}
		}
		else
		{
			 echo "<td style='background-color:#CCC'>$lib</td>";
			 if ($active==true)
			 {
				 echo "<td style='background-color:#CCC'>Activ&eacute;</td><td style='background-color:#CCC'><input type='submit' name='EtatD' value='Desactiver'></td>";
			 }
			 else
			 {
				echo "<td style='background-color:#CCC'>Desactiv&eacute;</td><td style='background-color:#CCC'><input type='submit' name='EtatA' value='Activer'></td>";
			 }


	}
echo "</tr> </form>";
	}
echo"</table></center>";
}
else
{
  echo '<script language="Javascript">
  <!--
  var t=setTimeout("document.location.replace(\'../seConnecter.php\')");
// -->
  //                         // </script>';
                         
}
?>
<body>
</body>
</html>
