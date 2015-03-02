<?php
session_start();

//connexion à la bdd
include("bdd_connexion.php");

//transmission des données dans la base de données
$requete = $bdd->prepare('INSERT INTO news(id_auteur,date_publication,titre,article) VALUES(?,NOW(),?,?)');
$requete->execute(array($_SESSION['id'], $_POST['titre'], $_POST['article']));

$requete->closeCursor();
//redirection vers le chat
header('Location: ../../index.php?page=news');
?>