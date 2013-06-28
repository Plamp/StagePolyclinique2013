<?php
session_start();
include("../include/connexion.php");
include("../style/style.css");

//___________________________________________________________________________________________________________________//
//------------------------------------------------Redirection selon les identifiants --------------------------------//
//___________________________________________________________________________________________________________________//

//quand le bouton est préssé

if(isset($_POST['connect']) && ($_POST['connect']=="Valider"))
{
	$_SESSION["login"]=$_POST["login"];
	$_SESSION["mdp"]=$_POST["mdp"];
	$login=$_SESSION["login"];
	$mdp=$_SESSION["mdp"];
	//requete identifiant
	$reqIdentifiant="Select * from Utilisateur where logUtil='$login' and mdpUtil='$mdp'";
	$resIdentifiant=mysql_query($reqIdentifiant);
	//si la requete ne renvoi pas de ligne
	if(mysql_num_rows($resIdentifiant)==0){

		echo '<script language="Javascript">
			<!--
			document.location.replace("avertissement.html");
		// -->
		// // </script>';
		}
		else
		{
	//boucle de test
	while($ligneLog=mysql_fetch_array($resIdentifiant))
	{
		$id=$ligneLog["idUtil"];
		if ($id==1)
		{
		    echo '<script language="Javascript">
		    <!--
                    document.location.replace("./Admin/MenuApp.php");
                    // -->
                    // // </script>';
		                    
		}
		elseif($id==2)
		{
		
			echo '<script language="Javascript">
				<!--
				document.location.replace("./GestionQuest/GestionQuest.php");
			// -->
			// // </script>';
		
		}
		elseif($id==3)
		{

echo '<script language="Javascript">
<!--
document.location.replace("./HEM/GestionHEM.php");
// -->
// </script>';
				}
		
	//fin de la boucle de test	
	}
	//fin if
		}
//fin if isset	
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Connexion</title>
</head>
<body>
<form name="Connexion" method="post" action="">
<fieldset style="vertical-align:central;text-align:center">
<h1> Veuillez vous connectez pour continuer</h1>

<center><table border="0">
<tr><td>Login : </td><td><input type="text" name="login" /></td></tr>
<tr><td>Mot de passe : </td><td><input type="password" name="mdp" /></td></tr>

</table>
<input type="submit" name="connect" value="Valider" /></center>



</fieldset>
</form>

</body>
</html>
