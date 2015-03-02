<?php
session_start();

//connexion à la bdd
include("bdd_connexion.php");

//transmission des nouvelles données dans la base
$requete = $bdd->prepare('UPDATE news SET titre = ?, article = ?, id_modificateur = ?, date_modif = NOW() WHERE id = ? ');	
$requete->execute(array($_POST['titre'], $_POST['article'], $_SESSION['id'], $_POST['id']) );
$requete->closeCursor();

$lien = '../../index.php?page=archives&id=' .$_POST['id'];

header("Location: $lien");

?>