<?php
session_start();

//connexion à la bdd
include("bdd_connexion.php");

//transmission des données dans la base de données
$requete = $bdd->prepare('INSERT INTO mini_chat(date_message,message,id_auteur) VALUES(NOW(),?,?)');
$requete->execute(array($_POST['message'], $_SESSION['id']));

$requete->closeCursor();
//redirection vers le chat
header('Location: ../../index.php?page=forum');
?>