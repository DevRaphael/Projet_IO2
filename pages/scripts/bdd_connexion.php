<?php
//connexion à la base de données bdd_io2 avec traitement d'erreur
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bdd_io2', 'root', '');
	$bdd->query('SET NAMES UTF8');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
