<?php

//connexion à la bdd
include("bdd_connexion.php");

//gestion des différents cas

//attribuer le statut simple membre
if($_POST['action']==1)
{
	$requete1 = $bdd->prepare('UPDATE comptes_membres SET droits = 1 WHERE id = ? ');	
	$requete1->execute(array($_GET['id']));

	$requete1->closeCursor();
}

elseif($_POST['action']==2)
{
	$requete1 = $bdd->prepare('UPDATE comptes_membres SET droits = 2 WHERE id = ? ');	
	$requete1->execute(array($_GET['id']));

	$requete1->closeCursor();
}

elseif($_POST['action']==3)
{
	$requete1 = $bdd->prepare('UPDATE comptes_membres SET droits = 3 WHERE id = ? ');	
	$requete1->execute(array($_GET['id']));

	$requete1->closeCursor();
}

elseif($_POST['action']==4)
{
	$requete1 = $bdd->prepare('DELETE FROM comptes_membres WHERE id = ? ');	
	$requete1->execute(array($_GET['id']));

	$requete1->closeCursor();
}

header('Location: ../../index.php?page=voirprofil&id=' .$_GET['id']);

?>