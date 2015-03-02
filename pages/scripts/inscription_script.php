<?php
session_destroy();

// fonction qui génère un mot de passe aléatoire
function mot_de_passe_genere()
{
	$taille=8;
   	$mot_de_passe="";
    $caracteres = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", 
	"i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

    for($i=1;$i<=$taille;$i++)
	{
        $mot_de_passe .= $caracteres[array_rand($caracteres)];
	}

return $mot_de_passe;
}

$mdp = mot_de_passe_genere();

//connexion à la bdd
include("bdd_connexion.php");

//vérification de l'identifiant et du mail dans la base de données
//en cas de doublon ça renvoie sur le formulaire avec un message d'erreur

//vérif identifiant
$requete1 = $bdd->prepare('SELECT identifiant FROM comptes_membres WHERE identifiant = ?');
						
$requete1->execute(array($_POST['identifiant']));

$donnees1 = $requete1->fetch();


//vérif mail
$requete2 = $bdd->prepare('SELECT email FROM comptes_membres WHERE email = ?');
						
$requete2->execute(array($_POST['email']));

$donnees2 = $requete2->fetch();


if( isset($donnees1['identifiant']) )
{
	$requete1->closeCursor();
	$requete2->closeCursor();
	header('Location: ../../index.php?page=inscription&erreur=1');
}
	elseif ( isset($donnees2['email']) )
	{
	$requete1->closeCursor();
	$requete2->closeCursor();
	header('Location: ../../index.php?page=inscription&erreur=2');
	}
	//s'il n'y a pas de doublon, on passe à l'inscription
	else
	{
$requete1->closeCursor();
$requete2->closeCursor();


//transmission des données dans la base de données
$requete3 = $bdd->prepare('INSERT INTO comptes_membres(identifiant,nom,prenom,date_naissance,departement,
						email,mot_de_passe,droits,date_inscription) 
						VALUES(?,?,?,?,?,?,?,?,CURDATE()) ');
						
$requete3->execute(array($_POST['identifiant'], $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'],
						$_POST['departement'], $_POST['email'], $mdp, 1) );

$requete3->closeCursor();

//enregistrement des 2 données transmises dans la page suivante
session_start();
$_SESSION['identifiant'] = $_POST['identifiant'];
$_SESSION['mot_de_passe'] = $mdp;

header('Location: ../../index.php?page=inscription_fin');

	}
?>