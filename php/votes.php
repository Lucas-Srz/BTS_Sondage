<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
		<title>Vote</title>
		<link rel="shortcut icon" type="image/x-icon" href="../Image/logo.png" />
		<link href="../style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
	
		<center>
			<h1 class="txt1"><strong>SONDAGE SUR LA PEUR</strong></h1>
		<h1 class="txt2">Aimez-vous avoir peur ?</h1><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

			<?php
				//Paramètre de connexion par défaut
				$MYSQL_SERVER = "localhost";
				$MYSQL_USER = "root";
				$MYSQL_PASSWORD = "";

				$DATABASE = "sondAge";
				$TABLE = "table_sondAge";

				$connexion = mysqli_connect($MYSQL_SERVER,$MYSQL_USER,$MYSQL_PASSWORD,$DATABASE);
				if (mysqli_connect_errno()) die("Connexion au serveur impossible ".mysqli_connect_error());

				if (isset($_POST["User"]) && isset($_POST["Age"]) && isset($_POST["genre"]) && isset($_POST["lieux"]))
				{
					$Utilisateur = $_POST["User"];
					$Age = $_POST["Age"];
					$Genre = $_POST["genre"];
					$Lieux = $_POST["lieux"];
					$Vote = $_POST["vote"];
					
					//Sécurité pour l'injection de code HTML, CSS et Javascript
						$Utilisateur = htmlspecialchars($Utilisateur);
						$Age = htmlspecialchars($Age);
						$Genre = htmlspecialchars($Genre);
						$Lieux = htmlspecialchars($Lieux);
						$Vote = htmlspecialchars($Vote);
					
					//- * - MARCHE PAS - * -
						//Sécurité pour l'injection de code SQL
						//$Utilisateur = mysqli_real_escape_string($Utilisateur);
						//$Age = mysqli_real_escape_string($Age);
						//$Genre = mysqli_real_escape_string($Genre);
						//$Lieux = mysqli_real_escape_string($Lieux);
						//$Vote = mysqli_real_escape_string($Vote);
					
					
					//Si le formulaire non complet
					if ($Utilisateur == "" || $Age == "" || $Genre == "" || $Lieux == "" || $Vote == "")
					{
						print "<strong><h3>Erreur : Formulaire incomplet !</strong></h3>";
					}

					//Test du format des données du formulaire
					elseif (preg_match("#[^a-zA-Z_]#",$Utilisateur) || preg_match("#[^a-zA-Z0-9_]#",$Genre))//Caractères autorisés pour l'Utilisateur
					{
						print "<strong><h3>Erreur : Les caractères autorisés sont : a-z A-Z _</strong></h3>";
					}
					elseif (preg_match("#[^0-9_]#",$Age)) //Caractères autorisés pour l'Age
					{
						print "<strong><h3>Erreur : Les caractères autorisés sont : 0-9 </strong></h3>";
					}
					elseif ($Lieux == "Lieux" || $Lieux == "- - - - -")
					{
						print "<strong><h3>Erreur : Le lieux n'est pas bon !</h3></strong>";
					}
					
					
					else
					{
						//Formulaire valide

						//On teste si le nom d'utilisateur est déjà utilisé
						//Requête SQL de recherche
						$requete = "SELECT Utilisateur FROM $TABLE WHERE Utilisateur = '$Utilisateur'";
						$resultat = mysqli_query($connexion,$requete) or die ("Exécution de la requête impossible ".mysqli_error($connexion));
						if ($resultat) //La fonction mysqli_num_rows() retourne le nombre de lignes
						{
							//Le nom d'utilisateur n'est pas utilisé
							//On ajoute une ligne dans la table
							$aujourdhui = date("Y-m-d"); //Date au format YYYY-mm-dd
							//Requête SQL d'insertion (nouvelle ligne)
							$requete = "INSERT INTO $TABLE(Utilisateur,date_inscription,Age,Genre,Lieux,Vote) VALUES('$Utilisateur','$aujourdhui','$Age','$Genre','$Lieux','$Vote')";	//Age a ajoutée ???
							$resultat = mysqli_query($connexion,$requete) or die ("Exécution de la requête impossible ".mysqli_error($connexion));

							print "<h3><center>Merci d'avoir voté !</center></h3>";
						}
						else print "<p>Erreur : Le nom '<strong> $Utilisateur </strong>' existe déjà !</p>";
					}
				}
				else print "<p>Valeurs invalides !</p>";

				//Déconnexion
				mysqli_close($connexion);
			?>
			
			<br><br>
			<form method="get" action="../index.php">
				<input type="submit" value="RETOUR" class="btn btnRetour">
			</form>
		
		</center>
    </body>
</html>