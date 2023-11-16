<meta charset="UTF-8">
<title>Reset</title>
<link rel="shortcut icon" type="image/x-icon" href="../Image/logo.png" />
<link href="../style.css" rel="stylesheet" type="text/css">
<?php
	//Paramètre de connexion par défaut
		$MYSQL_SERVER = "localhost";
		$MYSQL_USER = "root";
		$MYSQL_PASSWORD = "";

		$DATABASE = "sondage";
		$TABLE = "table_sondage";

		$connexion = mysqli_connect($MYSQL_SERVER,$MYSQL_USER,$MYSQL_PASSWORD,$DATABASE);
	
	//Requête SQL de lecture de la table avec tri par date
		$requete = "DELETE FROM table_sondage";
		$resultat = mysqli_query($connexion,$requete) or die ("Exécution de la requête impossible ");
		
		print "<br><center><h1> Page reset !<br> Vous avez reset votre table ! </h1></center>";
	
	//Déconnexion
		mysqli_close($connexion);
?>

	<a href="../html/connexion.html" class="btn btnRetour">Retour</a>