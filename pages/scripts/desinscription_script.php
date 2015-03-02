<?php
session_start();

//connexion à la bdd
include("bdd_connexion.php");


//Suppression du compte
$requete = $bdd->prepare('DELETE FROM comptes_membres WHERE id = ? ');
$requete->execute(array($_SESSION['id']));

$requete->closeCursor();

session_destroy();
header('Location: ../../index.php?page=news');
?>