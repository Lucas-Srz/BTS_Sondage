<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
		<link rel="shortcut icon" type="image/x-icon" href="Image/logo.png" />
		<link rel="stylesheet" href="style.css">
	</head>
	
	<body>
		<!--- Texte --->
			<h1 class="txt1">SONDAGE SUR LA PEUR</h1>
			<h1 class="txt2">Aimez-vous avoir peur ?</h1>
			<h1 class="txt3">Joyeux Halloween</h1>
			<h1 class="txt4">Nombre de visiteurs : 
				<?php
					$fichier = "Compteur_Visiteur.txt";

					//Ouverture et lecture du contenu du fichier
					$fp = fopen($fichier, 'r');
					$contenu = fread($fp,filesize($fichier));
					fclose($fp);

					//Mise à jour du compteur
					$compteur = intval($contenu) + 1;
					print "$compteur";

					//Mise à jour du fichier
					$fp = fopen($fichier, 'w');
					fwrite($fp, $compteur);
					fclose($fp);
				?>
			</h1>
		
		<!-- - Bouton - -->
			<a class="btn btnVote" href="html/vote.html">Voter</a>
			<a class="btn btnResultat" href="html/resultat.html">Resultat</a>
			<a class="btn btnConnexion" href="html/connexion.html">Connexions</a>
			
		
		<!-- - Audio - -->
			<audio id="myAudio" controls="">
				<source src="audio/audio.mp3" type="audio/mpeg">
				Votre navigateur ne supporte pas la balise audio.
			</audio>
	
	</body>
</html>