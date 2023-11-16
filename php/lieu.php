<?php
	require_once ('../jpgraph/jpgraph.php');
	require_once ('../jpgraph/jpgraph_pie.php');

	$ARA = 0;
	$BFC = 0;
	$BRE = 0;
	$CVL = 0;
	$COR = 0;
	$GES = 0;
	$HDF = 0;
	$IDF = 0;
	$NOR = 0;
	$NAQ = 0;
	$OCC = 0;
	$PDL = 0;
	$PAC = 0;
	$ROM = 0;

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
		$requete = "SELECT `lieux` FROM `table_sondage`;";
		$resultat = mysqli_query($connexion,$requete) or die ("Exécution de la requête impossible ".mysqli_error($connexion));

	//Récupération des données pour les mettre dans le graphe
		while($recv = mysqli_fetch_array($resultat,MYSQLI_ASSOC))
		{
			if($recv['lieux'] == "1")
			{
				$ARA++;
			}
			elseif($recv['lieux'] == "2")
			{
				$BFC++;
			}
			elseif($recv['lieux'] == "3")
			{
				$BRE++;
			}
			elseif($recv['lieux'] == "4")
			{
				$CVL++;
			}
			elseif($recv['lieux'] == "5")
			{
				$COR++;
			}
			elseif($recv['lieux'] == "6")
			{
				$GRS++;
			}
			elseif($recv['lieux'] == "7")
			{
				$HDF++;
			}
			elseif($recv['lieux'] == "8")
			{
				$IDF++;
			}
			elseif($recv['lieux'] == "9")
			{
				$NOR++;
			}
			elseif($recv['lieux'] == "10")
			{
				$NAQ++;
			}
			elseif($recv['lieux'] == "11")
			{
				$OCC++;
			}
			elseif($recv['lieux'] == "12")
			{
				$PDL++;
			}
			elseif($recv['lieux'] == "13")
			{
				$PAC++;
			}
			elseif($recv['lieux'] == "14" || "15" || "16" || "17" || "18")
			{
				$ROM++;
			}
		}

		$nb_votes = $ARA+$BFC+$BRE+$CVL+$COR+$GES+$HDF+$IDF+$NOR+$NAQ+$OCC+$PDL+$PAC+$ROM;//Calcule nombre de votes

	//Données du lieu pour réaliser le graphe
		$data = array($ARA,$BFC,$BRE,$CVL,$COR,$GES,$HDF,$IDF,$NOR,$NAQ,$OCC,$PDL,$PAC,$ROM);

	//Création du graphe
		$graph = new PieGraph(640,510,'auto');

		$theme_class="DefaultTheme";
		$graph->title->Set("Lieux de vie :");
		$graph->SetBox(true);

	//Créer le graphe
		$p1 = new PiePlot($data);
		$graph->Add($p1);
		$p1->ShowBorder();
		$p1->SetColor('black');
		$p1->SetSliceColors(array('#FF0000','#FFD800','#00FF21','#0026FF','#B200FF'));

	//Légend du graphe
		$legends = array('ARA (%d)','BFC (%d)','BRE (%d)','CVL (%d)','COR (%d)','GES (%d)','HDF (%d)','IDF (%d)','NOR (%d)','NAQ (%d)','OCC (%d)','PDL (%d)','PAC (%d)','ROM (%d)');
		$p1->SetLegends($legends);

		$graph->Stroke();
?>

