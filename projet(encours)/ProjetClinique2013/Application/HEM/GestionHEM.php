<?php
session_start();
?>
<html>
<head>
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

};
</style>
  <body>

<?php
if(($_SESSION["login"]=="plampson" && $_SESSION["mdp"]=="Clinalp01!") or ($_SESSION["login"]=="iprothoy" && $_SESSION["mdp"]=="Clinalp03!"))
{
	$login=$_SESSION["login"];
	$mdp=$_SESSION["mdp"];
	?>
    <h2><center><b> Gestion de la page : "L'homme en mouvement" </b></center></h2>
    <?php
	//si la catégorie est choisie
	if(isset($_POST["Categorie"]))
	{
		?>
		 <form enctype="multipart/form-data" action="fileupload.php" method="POST">
      <input type="hidden" name="MAX_FILE_SIZE" value="100000000000000000000" />
      Transfère le fichier <input type="file" name="monfichier" value="PDF" />
      <input type="submit" /><br />
        </form>
        <form action="" method="POST">
         Ou insérez le lien de la vidéo:<input type="text" name="lienvidéo" /><br />
          <input type="file" name="monfichier" value="VIDEO" />
      <input type="submit" />
      </form>
	  <?php
	}
	//sinon si l'utilisateur n'a pas encore choisi de catégorie, on lui affiche la liste
	else
	{
		$reqSelectCat="select * from CategorieHEM";
		$resSelectCat=mysql_query($reqSelectCat);
		if(mysql_num_rows($resSelectCat)==0){
		
			echo"<center><h3> Il n'y à pas de categorie renseigné. </h3></center>";
		}
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
	

		header('Location:/projects/ProjetClinique2013/Application/seConnecter.php');
}
