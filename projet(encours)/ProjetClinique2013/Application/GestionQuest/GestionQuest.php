<?php
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
</head>
  <body>

<?php
if(($_SESSION["login"]=="plampson" && $_SESSION["mdp"]=="Clinalp01!") or ($_SESSION["login"]=="froux" && $_SESSION["mdp"]=="Clinalp02!"))
{
	$login=$_SESSION["login"];
	$mdp=$_SESSION["mdp"];
	?>
    <h2><center><b> Gestion des questionnaires: </b></center></h2>
    <?php

}
?>
<body>
</body>
</html>