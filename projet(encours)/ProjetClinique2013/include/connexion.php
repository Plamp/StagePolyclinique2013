<?php
$hote ="127.0.0.1" ;
$user ="root";
$mdp  ="";
$db='Questionnaire';
if(mysql_connect($hote,$user, $mdp))
mysql_select_db($db);
?>