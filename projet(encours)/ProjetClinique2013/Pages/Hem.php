<head>
<meta http-equiv="Content-Type" content="text/html; charset='UTF-8'" /> 
<?php include ("../style/style.css");?>
<?php include ("../include/connexion.php")?>
<?php include("../include/entete.php");?>
<title>L'homme en mouvement</title>
</head>
<body>

<h2><center><strong>L'homme en mouvement :</strong></center></h2>
<p style="text-align: center;">Réalisé par le <strong>Docteur Ivan PROTHOY</strong>, médecin du sport.</p>
<p style="text-align: center;"><img  style="border: 1px solid black;" title="Dr. Ivan Prothoy." src="../Image/dr_ivan_prothoy.jpg" alt="" width="280" height="299" /></p>
<p style="text-align: center;"><strong>Dr Ivan PROTHOY</strong>
Lauréat de la faculté de médecine de Paris.
Médecine du sport. DIU de Traumatologie du sport.
DIU de médecine manuelle Ostéopathie.
DIU d’échographie de l'appareil locomoteur.
Posturologie.
Master STAPS "Physiologie et Biomécanique de l'Homme en mouvement".<span style="color: #ffffff;">.
</span>Ancien médecin des équipes de France de snowboard.
Médecin d'encadrement sur le terrain des équipes de France de ski alpin.</p>
<p style="text-align: center;"><strong>Prise de rendez-vous en ligne 24h/24: </strong><a title="Prendre rendez-vous." href="http://www.olras.com/clients/prothoy/agenda" target="_blank">http://www.olras.com/clients/prothoy/agenda</a></p>
<p style="text-align: center;"><strong>Tél :</strong><span><b> 04 92 43 46 74</b></span></p>
<p style="text-align: center;"><span style="color: #ffffff;">.</span></p>
<p style="text-align: center;"><strong>Différentes rubriques vous sont proposées :</strong></p>

<?php
//----------------------------------------------------------------------Gestion automatis� de la page par l'appli------------------------------------//

$reqSelectHem=" select * from CategorieHem";
$resSelectHem=mysql_query($reqSelectHem);
if(mysql_num_rows($resSelectHem)==0){
			
				echo"<center><h3> Il n'y a pas de rubriques proposées pour le moment.  </h3></center><br />";
}
else
{
while($hemLigne=mysql_fetch_array($resSelectHem))
{
	$idCat=$hemLigne["idCat"];
	$libCat=$hemLigne["libCat"];
	echo "<strong> $libCat :</strong><br>";

	$reqSelectArticle="Select TitreHem,lienHem from Hem where idCat=$idCat";
	$resSelectArticle=mysql_query($reqSelectArticle);
	if(mysql_num_rows($resSelectArticle)==0){
		
	 echo"<b> Il n'y a pas d'article lié a cette rubrique pour le moment. </b><br />";
	}
	else
	{
		while($articleLigne=mysql_fetch_array($resSelectArticle))
		{

			$titreHem=$articleLigne["TitreHem"];
			$lien=$articleLigne["lienHem"];
			echo "- <a href='$lien' target='_blank'>$titreHem</a><br />";
			//fin while Article
			
		}

		//fin else Article
	}
echo "<br />";

// Fin while Cat�gorie
}
//fin else Cat�gorie
}
?>




<?php include("../include/pied.php");?>
</div>
</body>
</html>
