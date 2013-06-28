<?php
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Selection de l'application</title>
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
if($_SESSION["login"]=="plampson" && $_SESSION["mdp"]=="Clinalp01!") 
{
	//------------------------------------------------------------Ajout d'un service-----------------------------------------------------------//
	if(isset($_POST["AjoutService"])=="Ajouter")
	{
		//recupération des données
		$idService=$_POST["ServiceId"];
		$libService=$_POST["ServiceName"];
		$reqInsertService="insert into Service Value('$idService','$libService')";
		$resInsertService=mysql_query($reqInsertService);
		echo '<script language="Javascript">
			<!--
			var t=setTimeout("document.location.replace(\'GestionService.php\')");
		// -->
		//                         // </script>';


		//fin de l'ajout de service	
	}
	//-------------------------------------------------------Suppression d'un service---------------------------------------------------------//
	elseif(isset($_POST["SupprService"])=="Supprimer")
	{
		//Recupération de l'id du service:
		$id=$_POST["idService"];
		//Requete : suppression en cascade du service
			//suppression des lit du service
			$reqSelectChambre="select idChambre from Chambre where idService='$id'";
			$resSelectChambre=mysql_query($reqSelectChambre);
			while($SelectChambre=mysql_fetch_array($resSelectChambre))
				{
				$idC=$SelectChambre["idChambre"];
				$reqDeleteLit="Delete from Lit where idChambre='$idC'";
		$resDeleteLit=mysql_query($reqDeleteLit);
		}
		//Suppression des chambre du service
		$reqDeleteChambre="Delete from Chambre where idService='$id'";
		$resDeleteChambre=mysql_query($reqDeleteChambre);
		//Suppression du service
		$reqDeleteService="Delete from Service where idService='$id'";
		$resDeleteService=mysql_query($reqDeleteService);
		echo '<script language="Javascript">
			<!--
			var t=setTimeout("document.location.replace(\'GestionService.php\')");
		// -->
		//                         // </script>';

	}
	//-------------------------------------------------------Modification d'un service-------------------------------------------------------//
	//---------------------------------------------------------Ajout d'une chambre-----------------------------------------------------------//
	elseif(isset($_POST["AjoutChambre"])=="Ajouter")
	{
		//recupération des données
		$idService=$_POST["idService"];
		$idChambre=$_POST["ChambreId"];
		$reqInsertChambre="insert into Chambre Value('$idChambre','$idService')";
		$resInsertChambre=mysql_query($reqInsertChambre);

		echo '<script language="Javascript">
			<!--
			var t=setTimeout("document.location.replace(\'GestionService.php\')");
		// -->
		//                         // </script>';


		//fin de l'ajout de chambre
	}
	//-------------------------------------------------------Suppression d'une chambre-------------------------------------------------------//
	elseif(isset($_POST["SupprChambre"])=="Supprimer")
	{
		//Recupération de l'id de la chambre:
		$id=$_POST["idChambre"];
		//Requete :Suppression en cascade de la chambre
			//suppression des lit
			$reqDeleteLit="Delete from Lit where idChambre='$id'";
		        $resDeleteLit=mysql_query($reqDeleteLit);
			//suppression de la chambre
			$reqDeleteChambre="Delete from Chambre where idChambre='$id'";
			$resDeleteChambre=mysql_query($reqDeleteChambre);

		echo '<script language="Javascript">
			<!--
			var t=setTimeout("document.location.replace(\'GestionService.php\')");
		// -->
		//                         // </script>';

	}
	//-----------------------------------------------------Modification d'une chambre--------------------------------------------------------//
	  //-------------------------------------------------------Suppression d'un lit----------------------------------------------------------//
	        elseif(isset($_POST["SupprLit"])=="Supprimer")
	      {
              //Recupération de l'id du lit:
               $id=$_POST["idLit"];
              //Requete :
               $reqDeleteLit="Delete from Lit where idLit='$id'";
                $resDeleteLit=mysql_query($reqDeleteLit);
               echo '<script language="Javascript">
                       <!--
                       var t=setTimeout("document.location.replace(\'GestionService.php\')");
               // -->
                //                         // </script>';
       }
       //---------------------------------------------------------Ajout d'un lit---------------------------------------------------------------//
	         elseif(isset($_POST["AjoutLit"])=="Ajouter")
	        {
	               //recupération des données
	              $idLit=$_POST["litId"];
	               $idChambre=$_POST["idChambre"];
	              $reqInsertLit="insert into Lit Value('$idLit','$idChambre')";
	                $resInsertLit=mysql_query($reqInsertLit);
		               echo '<script language="Javascript">
	                        <!--
	                        var t=setTimeout("document.location.replace(\'GestionService.php\')");
	              // -->
	               //                         // </script>';
			                //fin de l'ajout de chambre
	         }
	              
	//--------------------------------------------------------Affichage des lits-------------------------------------------------------------//
	elseif(isset($_POST["ModifChambre"])=="Modifier")
	{

		$id=$_POST["idChambre"];
		$lib=$_POST["libService"];
		echo " <center><h3><u> Gestion du service $lib </u></h3></center>";
	echo"<center><u> chambre $id </u></center><br />";
?> <center><table border=0,5px>
	       <th>Nom du lit</th>
	       <th>Suppression</th>
<?php 
		$reqSelectLit="select * from Lit where idChambre='$id'";
		$resSelectLit=mysql_query($reqSelectLit);
		$i=0;
		while($SelectLit=mysql_fetch_array($resSelectLit))
		{
			$i=$i+1;
			$libLit=$SelectLit["idLit"];
			echo "<form action='' name='FormLit' method='POST'>";
			if($i%2==1)
			{
				echo "<tr align='center' style='background-color:#CCCCFF;'>";
			}
			else
			{
				echo "<tr  align='center' style='background-color:#9999FF'>";
			}
			echo "<td>$libLit</td>";
			echo " <td><input type='submit' name='SupprLit' value='Supprimer'></td>";
			echo"</tr>";
			echo "<input type='hidden' name='idLit' value='$libLit'>";
			echo "</form>";
			//fin du while SelectLit
		}
		echo "</table></center>";
		echo "<form name='AjoutLit' method='POST' action=''>";
		echo"<br /><center><u>Ajouter un lit : </u></center><br />";
		echo"<input type='hidden' name='idChambre' value='$id'>";
		echo "<center><tr><td align='right' >Identifiant du lit :</td><td><input type='text' name='litId' ></td></tr></table></center>";
		echo "<br /><center><input type='submit' name='AjoutLit' value='Ajouter'></center>";
		//fin affichage des lits

		echo "<center><a href='GestionService.php'>Retour &aacute; la page d'acceuil de l'application</a></center>";
	}

	//----------------------------------------------------------Affichage des chambres-------------------------------------------------------//
	elseif(isset($_POST["ModifService"])=="Modifier")
	{
		$id=$_POST["idService"];
		$reqSelectService="select * from Service where idService='$id'";
		$resSelectService=mysql_query($reqSelectService);
		while($Select=mysql_fetch_array($resSelectService))
		{
			$lib=$Select["libService"];
			//Fin du while Select
		}

		echo " <center><h3><u> Gestion du service $lib </u></h3></center>"
?><center><u>Liste des chambres</u></center><br />	     
 <center><table border=0,5px>
	      <th>Nom de la chambre</th>
	      <th>Nombre de lit</th>
	      <th>Modification</th>
	     <th>Suppression</th>

<?php
			$reqSelectChambre="select * from Chambre where idService='$id'";
		$resSelectChambre=mysql_query($reqSelectChambre);
		$i=0;
		while($SelectChambre=mysql_fetch_array($resSelectChambre))
		{
			$i=$i+1;
			$libChambre=$SelectChambre["idChambre"];
			echo "<form action='' name='FormService' method='POST'>";
			if($i%2==1)
			{
				echo "<tr align='center' style='background-color:#CCCCFF;'>";
			}
			else
			{
				echo "<tr  align='center' style='background-color:#9999FF'>";
			}
			echo "<td>$libChambre</td>";
			$reqCountLit="select Count(*) as NbLit,idChambre from Lit where idChambre='$libChambre' group by idChambre";
			$resCountLit=mysql_query($reqCountLit);
			if(mysql_num_rows($resCountLit)==0)
			{
				echo "<td>0</td>";
			}
			else
			{
				while($CountLit=mysql_fetch_array($resCountLit))
				{
					$nbLit=$CountLit["NbLit"];
				}	 
				echo "<td> $nbLit </td>";
			} 
			echo " <td><input type='submit' name='ModifChambre' value='Modifier'></td><td><input type='submit' name='SupprChambre' value='Supprimer'></td>";
			echo"</tr>";
			echo "<input type='hidden' name='idChambre' value='$libChambre'>";
			echo "<input type='hidden' name='libService' value='$lib'>";
			echo "</form>";
			//fin du while SelectChambre
		}
		echo "</table></center>";
		echo "<form name='AjoutChambre' method='POST' action=''>";
		echo"<br /><center><u>Ajouter une chambre : </u></center><br />";
		echo"<input type='hidden' name='idService' value='$id'>";
		echo "<center><tr><td align='right' >Identifiant de la chambre :</td><td><input type='text' name='ChambreId' ></td></tr></table> </center>";
		echo "<br /><center><input type='submit' name='AjoutChambre' value='Ajouter'></center>";
		//fin affichage des chambres

		echo "<center><a href='GestionService.php'>Retour a la page d'acceuil de l'application</a></center>";
	}
	else
	{
		//-----------------------------------------------------------------Affichage---------------------------------------------------------------//
?>
    <center><h3><u> Selectionnez un service </u></h3></center>

 <center><table border=0,5px>
 <th>Libell&eacute; du service</th>
 <th>Modification</th>
 <th>Suppression</th>

<?php
		$reqSelectService="select * from Service";
		$resSelectService=mysql_query($reqSelectService);
		$i=0;
		while($SelectService=mysql_fetch_array($resSelectService))
		{
			$i=$i+1;
			$libService=$SelectService["libService"];
			$idService=$SelectService["idService"];
			echo "<form action='' name='FormService' method='POST'>";
			if($i%2==1)
			{
				echo "<tr align='center' style='background-color:#CCCCFF;'>";
			}
			else
			{
				echo "<tr  align='center' style='background-color:#9999FF'>";
			}
			echo "<td>$libService</td><td><input type='submit' name='ModifService' value='Modifier'></td><td><input type='submit' name='SupprService' value='Supprimer'></td>";
			echo"</tr>";
			echo "<input type='hidden' name='idService' value='$idService'>";
			echo "</form>";
			//fin du while Select Service
		}
		echo "</table></center>";
		echo "<form name='AjoutService' method='POST' action=''>";
		echo"<br /><center><u>Ajouter un service : </u></center><br />";
		echo "<center><table border=0><tr><td>Nom abr&eacute;g&eacute; (moins de 6 lettres-chiffres):</td><td> <input type='text' name='ServiceId'></td></tr></center> ";
		echo "<center><tr><td align='right' >Nom du service :</td><td><input type='text' name='ServiceName' ></td></tr></table> </center>";
		echo "<br /><center><input type='submit' name='AjoutService' value='Ajouter'></center>";
		//fin affichage de base
	}
	//Fin du if isset

	//-----------------------------------------------------------------Affichage---------------------------------------------------------------//

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
