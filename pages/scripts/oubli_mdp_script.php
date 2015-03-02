<?php

//connexion à la bdd
include("bdd_connexion.php");

//importation des données du membre et vérification des données entrées
$requete = $bdd->prepare('SELECT identifiant, mot_de_passe FROM comptes_membres
						WHERE identifiant = ? AND date_naissance = ? AND email = ?');
$requete->execute(array($_POST['identifiant'], $_POST['date_naissance'], $_POST['email']) );
$resultat = $requete->fetch();
 
if (!$resultat)
{
	$requete->closeCursor();
    header('Location: ../../index.php?page=erreur');
}
else
{
    session_start();
	$_SESSION['identifiant']= $resultat['identifiant'];
	$_SESSION['mot_de_passe']= $resultat['mot_de_passe'];
	$requete->closeCursor();
	header('Location: ../../index.php?page=oubli_mdp_fin');
}

?>