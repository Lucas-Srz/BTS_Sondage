<?php
	//Lien vers le jpgrapg
		require_once ('../jpgraph/jpgraph.php');
		require_once ('../jpgraph/jpgraph_line.php');
	
	//Initialisation des données
		$enfant = 0;
		$adolescents = 0;
		$adultes = 0;
		$aines = 0;

	//Paramètre de connexion par défaut
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
		$requete = "SELECT `age` FROM `table_sondage`;";
		$resultat = mysqli_query($connexion,$requete) or die ("Exécution de la requête impossible ".mysqli_error($connexion));

		while($recv = mysqli_fetch_array($resultat,MYSQLI_ASSOC))
		{
			//Récupération des données pour les mettre dans le graphe
			if($recv['age'] >= "1" && $recv['age'] <= "14")
			{
				$enfant++;
			}
			elseif($recv['age'] >= "15" && $recv['age'] <= "24")
			{
				$adolescents++;
			}
			elseif($recv['age'] >= "25" && $recv['age'] <= "64")
			{
				$adultes++;
			}
			elseif($recv['age'] >= "65" && $recv['age'] <= "100")
			{
				$aines++;
			}
		}

		$nb_votes = $enfant + $adolescents + $adultes + $aines;//Total du nombre de votes

	//Données du sondage pour réaliser le graphe
		$datay1 = array($enfant,$adolescents,$adultes,$aines);

	//Création du graphe
		$graph = new Graph(640,310);//Taille du graphe
		$graph->SetScale("textlin");

		$theme_class=new UniversalTheme;

		$graph->SetTheme($theme_class);
		$graph->img->SetAntiAliasing(false);
		$graph->title->Set('Sondage sur age :');//Titre
		$graph->SetBox(false);

		$graph->SetMargin(40,20,36,63);

		$graph->img->SetAntiAliasing();

		$graph->yaxis->HideZeroLabel();
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);

		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle("solid");
		$graph->xaxis->SetTickLabels(array('Enfant','Adolescents','Adultes','Aines'));//Légende
		$graph->xgrid->SetColor('#E3E3E3');

	//Création de la ligne
		$p1 = new LinePlot($datay1);
		$graph->Add($p1);

		$graph->legend->SetFrameWeight(1);

		$graph->Stroke();
?>

