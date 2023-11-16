<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
		<title>Admin</title>
		<link rel="shortcut icon" type="image/x-icon" href="../Image/logo.png" />
		<link href="../style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

			<?php
				//Connexion à la base de données MySQL

				//Paramètre de connexion par défaut
				$MYSQL_SERVER = "localhost";
				$MYSQL_USER = "root";
				$MYSQL_PASSWORD = "";

				$DATABASE = "sondage";	//PhpMyAdmin => Nom de la base de donnée
				$TABLE = "table_login";	//PhpMyAdmin => Nom de la table
				
				$TABLEDONNE = "table_sondage";	//PhpMyAdmin => Nom de la table

				$connexion = mysqli_connect($MYSQL_SERVER,$MYSQL_USER,$MYSQL_PASSWORD,$DATABASE);
				if (mysqli_connect_errno()) die("Connexion au serveur impossible ".mysqli_connect_error());

				if (isset($_POST["utilisateur"]) && isset($_POST["mot_de_passe"]))
				{
					$utilisateur = $_POST["utilisateur"];
					$mot_de_passe = $_POST["mot_de_passe"];
					
					//Sécurité pour l'injection de code HTML, CSS et JavaScript
					$utilisateur = htmlspecialchars($utilisateur);
					$mot_de_passe = htmlspecialchars($mot_de_passe);
					
				//- * - MARCHE PAS - * -
					//Sécurité pour l'injection de code SQL
					//$utilisateur = mysqli_real_escape_string($utilisateur);
					//$mot_de_passe = mysqli_real_escape_string($mot_de_passe);
					
					
					//Si le formulaire est bon
					if ($utilisateur == "admin" && $mot_de_passe == "admin")
					{
						print "<p>Informations :<br>[Date d'inscription] Nom | Age | Genre | Lieux | Vote</p><br>";
						print "<h3>Liste des utilisateurs et date d'inscription :</h3>";

						//Requête SQL de lecture de la table avec tri par date
						$requete = "SELECT utilisateur,date_inscription,age,Genre,Lieux,Vote FROM $TABLEDONNE ORDER BY date_inscription DESC";
						$resultat = mysqli_query($connexion,$requete) or die ("Exécution de la requête impossible ".mysqli_error($connexion));
						while($ligne = mysqli_fetch_array($resultat,MYSQLI_ASSOC))
						{
							//Affichage ligne par ligne
							print "[".$ligne['date_inscription']."] ".$ligne['utilisateur']." | ".$ligne['age']." | ".$ligne['Genre']." | ".$ligne['Lieux']." | ".$ligne['Vote']."<br>";
						}
						print "</p>"; ?>
						<!-- Bouton reset -->
						<form method="get" action="reset.php">
							<input type="submit" value=" RESET " class="btn btnReset2">
						</form>
						
						<!-- Box pour les informations des lieux -->
						<div id="boxLieu">
							<p>Légende pour le lieux :</p>
							<ul>
								<ol>
									<li>ARA</li>
									<li>BFC</li>
									<li>BRE</li>
									<li>CVL</li>
									<li>COR</li>
									<li>GES</li>
									<li>HDF</li>
									<li>IDF</li>
									<li>NOR</li>
									<li>NAQ</li>
									<li>OCC</li>
									<li>PDL</li>
									<li>PAC</li>
									<li>ROM</li>
								</ol>
							</ul>
						</div>
						
					<?php
					}
					//Si le formulaire est vide
					elseif ($utilisateur == "" || $mot_de_passe == "")
					{
						print "<p>Erreur : Formulaire incomplet !</p>";
					}
					else print "<p>Erreur : Mauvaise utilisateur ou / et mots de passe !</p>";
				}
				else print "<p>Erreur !</p>";

				//Déconnexion
				mysqli_close($connexion);
			?>

			<!-- Bouton retour -->
			<a class="btn btnConnexion" href="../index.php">Retour</a>
			
    </body>
</html>