<?php
$hote ="127.0.0.1" ;
$user ="root";
$mdp  ="";
$db='Questionnaire';
if(mysql_connect($hote,$user, $mdp))
mysql_select_db($db);
mysql_query ('SET NAMES UTF8'); //Solution pour les probl�mes d'encodage UTF-8
?>
