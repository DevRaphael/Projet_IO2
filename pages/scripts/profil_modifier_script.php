<?php
session_start();

//connexion à la bdd
include("bdd_connexion.php");


//transmission des nouvelles données dans la base
$requete = $bdd->prepare('UPDATE comptes_membres SET nom = ?, prenom = ?, date_naissance = ?, departement = ?, 
						email = ? WHERE id = ? ');	

$requete->execute(array($_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['departement'],
						$_POST['email'], $_SESSION['id']) );

$requete->closeCursor();


//importation des nouvelles données, l'intérêt est de récupérer le bon format de date grâce au SQL

$requete2 = $bdd->prepare('SELECT nom, prenom, date_naissance,
						DATE_FORMAT(date_naissance, \'%d/%m/%Y\') AS date_naissance_fr, departement, email 
						FROM comptes_membres WHERE identifiant = ?');
$requete2->execute(array($_SESSION['identifiant']));
 
$resultat = $requete2->fetch();

//mise à jour de la session
	$_SESSION['nom']= $resultat['nom'];
	$_SESSION['prenom']= $resultat['prenom'];
	$_SESSION['date_naissance_fr']= $resultat['date_naissance_fr'];
	$_SESSION['date_naissance_us']= $resultat['date_naissance'];
	$_SESSION['departement']= $resultat['departement'];
	$_SESSION['email']= $resultat['email'];

$requete2->closeCursor();
header('Location: ../../index.php?page=profil');

?>