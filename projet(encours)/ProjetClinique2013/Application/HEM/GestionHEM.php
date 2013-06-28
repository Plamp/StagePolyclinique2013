<?php
session_start();
if(($_SESSION["login"]=="plampson" && $_SESSION["mdp"]=="Clinalp01!") or ($_SESSION["login"]=="iprothoy" && $_SESSION["mdp"]=="Clinalp03!"))
{
	$login=$_SESSION["login"];
	$mdp=$_SESSION["mdp"];
?>
 <html>
 <head>

<meta http-equiv="Content-Type" content="text/html;  charset='UTF-8'" />

 <div id="divmiddle"><?php
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

 };
 </style>
</Head>
   <body>

    <h2><center><b> Gestion de la page : "L'homme en mouvement" </b></center></h2>
<?php
 //------------------------------------------------Suppression d'article---------------------------------------------------//
       if(isset($_POST["ArticleS"])=="Supprimer")
       {
	       				$idHem=$_POST["idHem"];
			               $idCat=$_POST["idCat"];
				               $reqDeleteHem="Delete from Hem where idCat=$idCat and idHem=$idHem";
				               $resDeleteHem=mysql_query($reqDeleteHem);
				
				       
         echo '<script language="Javascript">
							           <!--
								             document.location.replace("GestionHEM.php");
					                 // -->
					       //   // </script>';
	
       }

//----------------------------------------------Suppression de catégorie-----------------------------------------------//
       elseif(isset($_POST["CategorieS"])=="Supprimer")
	{
	$idCat=$_POST["idCat"];	
	$reqDeleteCat="Delete from CategorieHem where idCat=$idCat";
	$resDeleteCat=mysql_query($reqDeleteCat);
	        $reqDeleteHem="Delete from Hem where idCat=$idCat";
	        $resDeleteHem=mysql_query($reqDeleteHem);

  echo '<script language="Javascript">
          <!--
          document.location.replace("GestionHEM.php");
	  // -->
  // </script>';

	}
	//-------------------------------------------------Ajout de catégorie--------------------------------------------------//
		elseif(isset($_POST["CategorieA"])=="Ajouter")
	{
	$libCat=$_POST["ajoutCat"];	
	$reqInsertCat="insert into CategorieHem values(null,'$libCat')";
	$resInsertCat=mysql_query($reqInsertCat);


 echo '<script language="Javascript">
	 <!--
	 document.location.replace("GestionHEM.php");
 // -->
 // </script>';
	}
//----------------------------------------------Ajout d'un article(vidéo)----------------------------------------------//
		elseif(isset($_POST["monfichierV"])=="Video")
	{
	$idCat=$_POST["idCat"];	
	$ajoutArt=$_POST["ajoutArt"];
	$lien=$_POST["lienvideo"];
	$reqInsertLien="Insert into Hem values(null,'$ajoutArt".'(vidÃ©o)'."','$lien',$idCat)";
	$resInsertLien=mysql_query($reqInsertLien);	
	
	  echo '<script language="Javascript">
	         <!--
	  document.location.replace("GestionHEM.php");
	  // -->
	  // </script>';
	 
	
	}
//---------------------------------------------Modification de catégorie-----------------------------------------------// 
		//si la catégorie est choisie
	elseif(isset($_POST["CategorieM"])=="Modifier")
	{
		$idCat=$_POST["idCat"];
		$reqSelectHem="select TitreHem,idHem from Hem where idCat=$idCat";
		$resSelectHem=mysql_query($reqSelectHem);
		
		$libCat=$_POST["LibCat"];
		if(mysql_num_rows($resSelectHem)==0){
		
			echo"<center><h3> Il n'y a"." pas d'article renseign&eacute; pour la cat&eacute;gorie ".$libCat.". </h3></center><br />";
			echo "<h3><center><b>Ajouter un article</b></center></h3><br />";
			?>
            <center>
         <form enctype="multipart/form-data" name="formPdf" action="fileupload.php" method="POST">
         <input type="hidden" name="idCat" value="<?=$idCat?>" />
      	<input type="hidden" name="MAX_FILE_SIZE" value="100000000000000000000" />
      	Transf&egrave;re le fichier <input type="file" name="monfichierP" value="PDF" />
		<center>Titre du pdf:<input type='text' name='ajoutArt'/></center> <br/>
      	<input type="submit" value="Pdf" /><br />
        </form>
         <hr style="width:30%">
        <form action="" name="formVideo" method="POST">
         <input type="hidden" name="idCat" value="<?=$idCat?>" />
        <h2><center>Ou</center></h2><br /> ins&eacute;rez le lien de la vid&eacute;o:<input type="text" name="lienvideo" /><br />
		<center>Titre de la vid&eacute;o:<input type='text' name='ajoutArt'/></center> <br/>
		
        <input type="submit" name="monfichierV" value="Video" />
      	</form></center>
                 <br /><h3><center><a href='GestionHEM.php'> Retour &aacute; la page de gestion</a></center></h3>
        	<?php
			//fin if
			}
		else
			{
			$resSelectHem2=mysql_query($reqSelectHem);
			echo "<table align='center' border='1px' style='font-family:Verdana'>";
			echo "<th style='width:300px;background-color:#FFF;font-family:Verdana'>Article</th><th style='background-color:#FFF;font-family:Verdana'>Modifier</th>";
			$i=0;
			while($LigneHem=mysql_fetch_array($resSelectHem2))
				{
					$Article=$LigneHem["TitreHem"];
					$idArticle=$LigneHem["idHem"];
				$i=$i+1;

				if ($i%2==0)
					{
					?>
          
            		<form action="" name="formaction2" method="POST">
            		<tr>
            		<td style="background-color:#999"><?php echo $Article ;?></td>
            		<td style="background-color:#999"><input type="submit" name="ArticleS" value="Supprimer" /></td>
  <input type="hidden" name="idHem" value="<?=$idArticle?>" />


</tr>
            		<input type="hidden" name="idCat" value="<?=$idCat?>" />
                	</form>  
            		<?php
            		}
           	 		else
					{
					?>
                    <form name="formaction2" action="" method="POST">
                    <tr>
  <input type="hidden" name="idHem" value="<?=$idArticle?>" />

  <input type="hidden" name="idCat" value="<?=$idCat?>" />

	<td style="background-color:#CCC"><?php echo $Article ;?></td>
                    <td style="background-color:#CCC"><input type="submit" name="ArticleS" value="Supprimer" /></td>
                    </tr>
                    </form> <?php
            		} 
					
            	}
             echo "</table>";
				        echo "<br /><h3><center><b>Ajouter un article</b></center></h3><br />";
		?>
        <center>
           
		<form enctype="multipart/form-data" name="formPdf" action="fileupload.php" method="POST">
         <input type="hidden" name="idCat" value="<?=$idCat?>" />
	<input type="hidden" name="MAX_FILE_SIZE" value="100000000000000000000" />
  <input type="hidden" name="idHem" value="<?=$idArticle?>" />

      	Transf&egrave;re le fichier <input type="file" name="monfichierP" value="PDF" />
		<center>Titre du pdf:<input type='text' name='ajoutArt'/></center> <br/>
      	<input type="submit" value="Pdf"/><br />
        </form>
        <hr style="width:30%">
        <form action="" name="formVideo" method="POST">
	 <input type="hidden" name="idCat" value="<?=$idCat?>" />
	<input type="hidden" name="idHem" value="<?=$idArticle?>" />
      <h2><center>Ou</center></h2><br />  ins&eacute;rez le lien de la vid&eacute;o:<input type="text" name="lienvideo" /><br />
		<center>Titre de la vid&eacute;o:<input type='text' name='ajoutArt'/></center> <br/>
	     <input type="submit" name="monfichierV" value="Video" />
      	</form></center>
                 <br /><h3><center><a href='GestionHEM.php'> Retour &aacute; la page de gestion</a></center></h3>
        	  <?php
		}
	}
//______________________________________________________________________________________________________________________________________________________//
	//sinon si l'utilisateur n'a pas encore choisi de catégorie, on lui affiche la liste
	else
	{
		$reqSelectCat="select * from CategorieHem";
		$resSelectCat=mysql_query($reqSelectCat);
		if(mysql_num_rows($resSelectCat)==0){
		
			echo"<center><h3> Il n'y a pas de cat&eacute;gorie renseign&eacute. </h3></center>";
				echo "<form action='' name='formAjout0' method='POST'>";
					echo "<br />";
		echo "<h3><center><b>Ajouter une cat&eacute;gorie</b></center></h3><br />";
		echo "<center>Nom de la cat&eacute;gorie:<input type='text' name='ajoutCat'/>";
		echo "<input type='submit' name='CategorieA' value='Ajouter' /></center>";
		echo "<form>";
		//fin if
		}
		else
		{
			echo"<center><h3> Voici la liste de vos cat&eacute;gories :</h3></center>";
		$resSelectCat2=mysql_query($reqSelectCat);
		echo "<table align='center' border='1px' style='font-family:Verdana'>";
		echo "<th style='width:300px;background-color:#FFF;font-family:Verdana'>Nom de la cat&eacute;gorie</th><th style='background-color:#FFF;font-family:Verdana'>Modifier</th><th style='background-color:#FFF;font-family:Verdana'>Supprimer</th>";
		$i=0;
		while($LigneCat=mysql_fetch_array($resSelectCat2))
		{
			$i=$i+1;
			$nomCat=$LigneCat["libCat"];
			$idCat=$LigneCat["idCat"];
			if ($i%2==0)
			{
			?>
          
            <form action="" name="formaction0" method="POST">
            <tr>
            <td style="background-color:#999"><?php echo $nomCat ;?></td>
            <td style="background-color:#999"><input type="submit" name="CategorieM" value="Modifier" /></td>
            <td style="background-color:#999"><input type="submit" name="CategorieS" value="Supprimer" /></td>
            </tr>
                   <input type="hidden" name="LibCat" value="<?=$nomCat?>" />
            <input type="hidden" name="idCat" value="<?=$idCat?>" />
                </form>  
            <?php
            }
            else
			{?>
				     <form name="formaction1" action="" method="POST">
            <tr>
            <td style="background-color:#CCC"><?php echo $nomCat ;?></td>
            <td style="background-color:#CCC"><input type="submit" name="CategorieM" value="Modifier" /></td>
            <td style="background-color:#CCC"><input type="submit" name="CategorieS" value="Supprimer" /></td>
            </tr>
            <input type="hidden" name="LibCat" value="<?=$nomCat?>" />
            <input type="hidden" name="idCat" value="<?=$idCat?>" />
            </form> 
            
              <?php
            }
    
             
         
		//fin du while $LigneCat	
		}
		echo "<form action='' name='formAjout1' method='POST'>";
		echo "</table><br />";
		echo "<h3><center><b>Ajouter une cat&eacute;gorie</b></center></h3><br />";
		echo "<center>Nom de la cat&eacute;gorie:<input type='text' name='ajoutCat'/>";
		echo "<input type='submit' name='CategorieA' value='Ajouter' /></center>";
		echo "</form>";
		//fin else	
		}
	//fin else
	} 
	?>
</div>
  </body>
</html>

<?php

//fin if isset
}
else
{
header('Location:/ProjetClinique2013/Application/seConnecter.php');
}
