<?php

//connexion à la bdd
include("bdd_connexion.php");

//requête de suppression
$requete = $bdd->exec('DELETE FROM mini_chat');

//redirection vers le forum
header('Location: ../../index.php?page=forum');
?>