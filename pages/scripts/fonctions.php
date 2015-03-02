<?php

//FONCTION 1
//Fonction d'affichage de la liste des membres dans un tableau trié

function afficherTableauMembres()
{

$tableau_entete = '<table><thead><tr>';
$tableau_entete .= '<td><a href="index.php?page=membres&tri=nom" class="lien-profil">Nom <img src="images/fleche_bas.gif" alt="" /></a></td>';
$tableau_entete .= '<td><a href="index.php?page=membres&tri=prenom" class="lien-profil">Prénom <img src="images/fleche_bas.gif" alt="" /></a></td>';
$tableau_entete .= '<td><a href="index.php?page=membres&tri=localisation" class="lien-profil">Localisation <img src="images/fleche_bas.gif" alt="" /></a></td>';
$tableau_entete .= '<td><a href="index.php?page=membres&tri=statut" class="lien-profil">Statut <img src="images/fleche_bas.gif" alt="" /></a></td>';
$tableau_entete .= '<td><a href="index.php?page=membres&tri=inscritle" class="lien-profil">Inscrit le : <img src="images/fleche_bas.gif" alt="" /></a></td>';
$tableau_entete .= '</tr></thead><tbody>';

echo $tableau_entete;


global $bdd;

//importation des informations des membres selon la variable tri


if(!isset($_GET['tri']))
	{
	$requete3 = $bdd->query('SELECT id, nom, prenom, departement, droits, 
						DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS date_inscription_fr  
						FROM comptes_membres ORDER BY id');
	}
	elseif($_GET['tri']=='nom')
	{
	$requete3 = $bdd->query('SELECT id, nom, prenom, departement, droits, 
							DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS date_inscription_fr  
							FROM comptes_membres ORDER BY nom');
	}
	elseif($_GET['tri']=='prenom')
	{
	$requete3 = $bdd->query('SELECT id, nom, prenom, departement, droits, 
						DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS date_inscription_fr  
						FROM comptes_membres ORDER BY prenom');
	}
	elseif($_GET['tri']=='localisation')
	{
	$requete3 = $bdd->query('SELECT id, nom, prenom, departement, droits, 
						DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS date_inscription_fr  
						FROM comptes_membres ORDER BY departement');
	}
	elseif($_GET['tri']=='statut')
	{
	$requete3 = $bdd->query('SELECT id, nom, prenom, departement, droits, 
						DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS date_inscription_fr  
						FROM comptes_membres ORDER BY droits DESC');
	}
	elseif($_GET['tri']=='inscritle')
	{
	$requete3 = $bdd->query('SELECT id, nom, prenom, departement, droits, 
						DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS date_inscription_fr  
						FROM comptes_membres ORDER BY date_inscription');
	}


//variable à incrémenter pour changer la couleur de fond 1 fois sur 2
$i = 0;

// Affichage des données
while ($donnees3 = $requete3->fetch())
{
			//changement de couleur en fonction de i
			if($i%2==0)
				//changement de couloir pour la ligne de notre compte
				if($_SESSION['id']==$donnees3['id'])
					echo '<tr class="moi">';
				else
					echo '<tr>';
			else
				if($_SESSION['id']==$donnees3['id'])
					echo '<tr class="moi">';
				else
					echo '<tr class="ligne-membre">';

			//changement du lien, si on clique sur son propre profil on arrive sur notre page profil
				if($_SESSION['id']==$donnees3['id'])
				{
				echo '<td><a href="index.php?page=profil" class="lien-profil">' .strtoupper(htmlspecialchars($donnees3['nom'])) .'</a></td>';
				echo '<td><a href="index.php?page=profil" class="lien-profil">' .htmlspecialchars($donnees3['prenom']) .'</a></td>';
				}
				else
				{
				echo '<td><a href="index.php?page=voirprofil&amp;id=' .$donnees3['id'] .'" class="lien-profil">' .strtoupper(htmlspecialchars($donnees3['nom'])) .'</a></td>';
				echo '<td><a href="index.php?page=voirprofil&amp;id=' .$donnees3['id'] .'" class="lien-profil">' .htmlspecialchars($donnees3['prenom']) .'</a></td>';
				}
			
				echo '<td class="petit">' .$donnees3['departement'] .'</td>';
				echo '<td class="petit">';
						if($donnees3['droits']==1)
								echo 'Membre';
									elseif($donnees3['droits']==2)
										echo '<span class="bleu"><strong>Membre LEA</strong></span>';
											elseif($donnees3['droits']==3)
												echo '<span class="rouge"><strong>Administrateur</strong></span></td>';
									
				echo '<td>' .$donnees3['date_inscription_fr'] .'</td>';
				echo '</tr>';
$i++;		
}

echo '</tbody></table>';

$requete3->closeCursor();
}

//FIN DE LA PREMIERE FONCTION
?>



<?php
//FONCTION 2
//Fonction d'affichage du nombre de membres

function afficherNbMembres()
{
global $bdd;

//importation et affichage du nombre d'inscrits
$requete4 = $bdd->query('SELECT COUNT(*) AS nb_inscrits FROM comptes_membres');
$donnees4 = $requete4->fetch();

echo '<p class="petit">- Il y a <strong>' .$donnees4['nb_inscrits'] .'</strong> membres enregistrés.</p>';

$requete4->closeCursor();
}
//FIN
?>


<?php
//FONCTION 3
//Fonction d'affichage du nombre de membres par statut

function afficherNbMembresStatut()
{
global $bdd;

//importations
$requete5 = $bdd->query('SELECT COUNT(*) AS nb_admin FROM comptes_membres WHERE droits = 3 ');
$donnees5 = $requete5->fetch();

$requete6 = $bdd->query('SELECT COUNT(*) AS nb_modo FROM comptes_membres WHERE droits = 2 ');
$donnees6 = $requete6->fetch();

$requete7 = $bdd->query('SELECT COUNT(*) AS nb_simple FROM comptes_membres WHERE droits = 1 ');
$donnees7 = $requete7->fetch();

echo '<p class="petit">- <strong>' .$donnees5['nb_admin'] .'<span class="rouge"> administrateurs</span></strong> , 
		<strong>' .$donnees6['nb_modo'] .'<span class="bleu"> membres LEA</span></strong> et 
		<strong>' .$donnees7['nb_simple'] .'<span class="vert"> simples membres</span></strong>.</p>';

$requete5->closeCursor();
$requete6->closeCursor();
$requete7->closeCursor();
}
//FIN
?>


<?php
//FONCTION 4
//Fonction d'affichage du nombres de messages dans le forum

function afficherNbMessagesForum()
{
global $bdd;

//importation
$requete8 = $bdd->query('SELECT COUNT(*) AS nb_msg FROM mini_chat');
$donnees8 = $requete8->fetch();

if( $donnees8['nb_msg']==0)
	echo '<p class="petit">- Aucun message n\'a encore été posté dans le forum.</p>';
else
	echo '<p class="petit">- Nos membres ont posté <strong>' .$donnees8['nb_msg'] .'</strong> messages dans le forum.</p>';

$requete8->closeCursor();
}
//FIN
?>



<?php

//FONCTION 5
//Fonction d'affichage du tableau de statistiques

function afficherTableauStatistiques()
{

$tableau_entete = '<table><thead><tr>';
$tableau_entete .= '<td>Nom</td>';
$tableau_entete .= '<td>Prénom</td>';
$tableau_entete .= '<td>Publications</td>';
$tableau_entete .= '<td>Messages</td>';
$tableau_entete .= '<td>Connexions</td>';
$tableau_entete .= '</tr></thead><tbody>';

echo $tableau_entete;

global $bdd;

//importation des informations des membres selon la variable tri

$requete9 = $bdd->query('SELECT id, nom, prenom, compteur_connexions FROM comptes_membres ORDER BY compteur_connexions DESC');

//variable à incrémenter pour changer la couleur de fond 1 fois sur 2
$i = 0;

// Affichage des données
while ($donnees9 = $requete9->fetch())
{
			//changement de couleur en fonction de i
			if($i%2==0)
				//changement de couloir pour la ligne de notre compte
				if($_SESSION['id']==$donnees9['id'])
					echo '<tr class="moi">';
				else
					echo '<tr>';
			else
				if($_SESSION['id']==$donnees9['id'])
					echo '<tr class="moi">';
				else
					echo '<tr class="ligne-membre">';

			//changement du lien, si on clique sur son propre profil on arrive sur notre page profil
				if($_SESSION['id']==$donnees9['id'])
				{
				echo '<td><a href="index.php?page=profil" class="lien-profil">' .strtoupper(htmlspecialchars($donnees9['nom'])) .'</a></td>';
				echo '<td><a href="index.php?page=profil" class="lien-profil">' .htmlspecialchars($donnees9['prenom']) .'</a></td>';
				}
				else
				{
				echo '<td><a href="index.php?page=voirprofil&amp;id=' .$donnees9['id'] .'" class="lien-profil">' .strtoupper(htmlspecialchars($donnees9['nom'])) .'</a></td>';
				echo '<td><a href="index.php?page=voirprofil&amp;id=' .$donnees9['id'] .'" class="lien-profil">' .htmlspecialchars($donnees9['prenom']) .'</a></td>';
				}
			
				//nombre de publications
				$requete11 = $bdd->prepare('SELECT COUNT(*) AS nb_pub FROM news WHERE id_auteur = ?');
				$requete11->execute(array($donnees9['id']));
				$donnees11 = $requete11->fetch();
				echo '<td align="center">' .$donnees11['nb_pub'] .'</td>';
				$requete11->closeCursor();
				
				//nombre de messages
				$requete10 = $bdd->prepare('SELECT COUNT(*) AS nb_msg FROM mini_chat WHERE id_auteur = ?');
				$requete10->execute(array($donnees9['id']));
				$donnees10 = $requete10->fetch();
				echo '<td align="center">' .$donnees10['nb_msg'] .'</td>';
				$requete10->closeCursor();
				
				//nombre de connexions
				echo '<td align="center">' .$donnees9['compteur_connexions'] .'</td>';
				echo '</tr>';
$i++;		
}

echo '</tbody></table>';

$requete9->closeCursor();
}

//FIN
?>



<?php
//FONCTION 6
//Fonction d'affichage du nombres de publications d'articles

function afficherNbPublications()
{
global $bdd;

//importation
$requete12 = $bdd->query('SELECT COUNT(*) AS nb_publi FROM news');
$donnees12 = $requete12->fetch();

if( $donnees12['nb_publi']==0)
	echo '<p class="petit">- Aucun article n\'a encore été publié.</p>';
else
	echo '<p class="petit">- <strong>' .$donnees12['nb_publi'] .'</strong> articles ont été publiés.</p>';

$requete12->closeCursor();
}
//FIN
?>
