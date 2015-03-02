<?php

//connexion à la bdd
include("bdd_connexion.php");

//importation des données du membre et vérification des données entrées
$requete = $bdd->prepare('SELECT id, identifiant, nom, prenom, date_naissance,
						DATE_FORMAT(date_naissance, \'%d/%m/%Y\') AS date_naissance_fr,
						departement, email, droits, 
						DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS date_inscription_fr 
						FROM comptes_membres WHERE identifiant = ? AND mot_de_passe = ?');
$requete->execute(array($_POST['identifiant'], $_POST['mot_de_passe']));
 
$resultat = $requete->fetch();
 
if (!$resultat)
{
	//si l'identifiant et le mdp ne correspondent pas au compte d'un membre, on est redirigé vers la page d'erreur
	$requete->closeCursor();
    header('Location: ../../index.php?page=erreur');
}
else
{
	//incrémente le compteur de connexions du membre
	$requete2 = $bdd->prepare('UPDATE comptes_membres SET compteur_connexions = compteur_connexions +1 WHERE id = ?');				
	$requete2->execute(array($resultat['id']) );
	$requete2->closeCursor();

	//démarre la session
    session_start();
    $_SESSION['id'] = $resultat['id'];
	$_SESSION['identifiant']= $resultat['identifiant'];
	$_SESSION['nom']= $resultat['nom'];
	$_SESSION['prenom']= $resultat['prenom'];
	$_SESSION['date_naissance_fr']= $resultat['date_naissance_fr'];
	$_SESSION['date_naissance_us']= $resultat['date_naissance'];
	$_SESSION['departement']= $resultat['departement'];
	$_SESSION['email']= $resultat['email'];
	$_SESSION['droits']= $resultat['droits'];
	$_SESSION['date_inscription']= $resultat['date_inscription_fr'];
	$requete->closeCursor();
	
	//renvoie sur la page d'accueil
	header('Location: ../../index.php?page=news');
}

?>