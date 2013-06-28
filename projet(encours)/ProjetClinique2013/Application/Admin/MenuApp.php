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
	?>
    <h2><center><b> Selection de l'application </b></center></h2><br />
<center><table border=0>
<tr><td><a href="../HEM/GestionHEM.php">Gestion de la page : "L'homme en mouvement"</a></td></tr>
<tr><td><a href="../GestionQuest/GestionQuest.php">Gestion des questionnaires</a></td></tr>
<tr><td><a href="../Admin/GestionService.php">Gestion des Services</a></td></tr>
</table></center>
<?php
      
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
