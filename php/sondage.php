<?php
	//Lien vers le jpgrapg
		require_once ('../jpgraph/jpgraph.php');
		require_once ('../jpgraph/jpgraph_pie.php');
		require_once ('../jpgraph/jpgraph_pie3d.php');
	
	//Initialisation des données
		$oui = 0;
		$non = 0;

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
		$requete = "SELECT `vote` FROM `table_sondage`;";
		$resultat = mysqli_query($connexion,$requete) or die ("Exécution de la requête impossible ".mysqli_error($connexion));

		while($recv = mysqli_fetch_array($resultat,MYSQLI_ASSOC))
		{
			//Récupération des données pour les mettre dans le graphe
			if($recv['vote'] == "Oui")
			{
				$oui++;
			}
			else
			{
				$non++;
			}
		}

		$nb_votes = $non + $oui;//Total du nombre de votes

	//Données du sondage pour réaliser le graphe
		$data = array($oui,$non);

	//Création du graphe 
		$graph = new PieGraph(640,410);//Taille du graph

		$theme_class= new VividTheme;
		$graph->SetTheme($theme_class);
		$graph->title->Set("Résultat au sondage :");

	//Création du cercle
		$p1 = new PiePlot3D($data);
		$graph->Add($p1);

		$p1->ShowBorder();
		$p1->SetColor('black');
		$p1->ExplodeSlice(1);

	//Légende
		$legends = array('OUI (%d)','NON (%d)');
		$p1->SetLegends($legends);
		$graph->legend->Pos(0.37,0.1);

		$graph->Stroke();
?>