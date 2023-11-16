<?php
	require_once ('../jpgraph/jpgraph.php');
	require_once ('../jpgraph/jpgraph_bar.php');

	$male = 0;
	$female = 0;

	$MYSQL_SERVER = "localhost";
	$MYSQL_USER = "root";
	$MYSQL_PASSWORD = "";

	$DATABASE = "sondage";
	$TABLE = "table_sondage";

	//Connexion à la base de données
		$connexion = mysqli_connect($MYSQL_SERVER,$MYSQL_USER,$MYSQL_PASSWORD,$DATABASE);

	//Tests de connexion à la base de données
		if (mysqli_connect_errno()) die("Connexion au serveur impossible ".mysqli_connect_error());

	//Requête SQL
		$requete = "SELECT `genre` FROM `table_sondage`;";
		$resultat = mysqli_query($connexion,$requete) or die ("Exécution de la requête impossible ".mysqli_error($connexion));

	//Récupération des données pour les mettre dans le graphe
		while($recv = mysqli_fetch_array($resultat,MYSQLI_ASSOC))
		{
			if($recv['genre'] == "male")
			{
				$male++;
			}
			elseif($recv['genre'] == "female")
			{
				$female++;
			}
		}

		$nb_votes = $male + $female;

	//Données du sondage pour réaliser le graphe
		$datay=array($male,$female);

	//Création du graphe
		$graph = new Graph(640,310,'auto');
		$graph->SetScale("textlin");

		$graph->yaxis->SetTickPositions(array(0,2,4,6,8,10), array(0,5,10,15));
		$graph->SetBox(false);

		$graph->ygrid->SetFill(false);
		$graph->xaxis->SetTickLabels(array('Homme','Femme'));
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);

	//Creation des bars
		$b1plot = new BarPlot($datay);
		
		$graph->Add($b1plot);
	
		$b1plot->SetColor("white");
		$b1plot->SetFillGradient("#FF8833",'darkred',GRAD_VER);
		$b1plot->SetWidth(45);
		$graph->title->Set("Sondage sur le genre :");

		$graph->Stroke();
?>