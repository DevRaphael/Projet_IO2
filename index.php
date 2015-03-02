<?php
session_start();

//connexion à la bdd
include("pages/scripts/bdd_connexion.php"); 
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Projet IO2</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" media="screen and (max-width: 1100px)" type="text/css" href="styles/style.css" />
		<link rel="stylesheet" media="screen and (max-width: 840px)" href="styles/style_petit.css" />
		<link rel="stylesheet" media="screen and (min-width: 1100px)" href="styles/style_grand.css" />
	</head>

	<body id="hdp">
		<div id="cadre1">

<?php 
//inclusion de l'interface et des pages centrales
include("interface/header.php");
include("interface/menu_gauche.php");
include("pages/scripts/pages_centrales.php");

//affichage de la section membres uniquement pour les membres connectés
			if( isset($_SESSION['droits']) )
				include("interface/menu_droite.php");
							
include("interface/footer.php"); 
?>

		</div>
   </body>
</html>