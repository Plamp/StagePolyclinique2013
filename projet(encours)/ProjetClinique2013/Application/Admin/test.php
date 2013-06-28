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
                         echo "<tr style='background-color:#CCCCFF'>";
                 }
                 else
                 {
                        echo "<tr style='background-color:#9999FF'>";
                }
                 echo "<td>$libService</td>";
         //fin du while Select Service
        }
         echo "</table></center>";
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
