<section>
<strong><a href="index.php?page=membres" class="lien-profil">Communauté</a> > <img src="images/voirprofil.gif" alt="" /> 
<a href="index.php?page=voirprofil&id=<?php echo $_GET['id']; ?>" class="lien-profil">Profil :</a></strong><br/><br/>

<div class="cadre-profil">

<?php

global $bdd;

//importation des informations du membre à l'aide de l'id passé en GET
$requete = $bdd->prepare('SELECT id, nom, prenom, date_naissance,
						DATE_FORMAT(date_naissance, \'%d/%m/%Y\') AS date_naissance_fr,
						departement, email, droits, 
						DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS date_inscription_fr 
						FROM comptes_membres WHERE id = ?');
$requete->execute(array($_GET['id']));
 
$donnees = $requete->fetch();

//gestion du cas où l'utilisateur rentre volontairement un mauvais id dans la barre d'adresse
//gestion aussi du cas où on vient de supprimer un compte, on est redirigé vers la liste des membres
if(!isset($donnees['id']))
	header('Location: index.php?page=membres');

?>

<?php
//affichage du prénom avec la couleur du statut en fond
if ($donnees['droits']==1)
	echo '<div class="membre">' .htmlspecialchars($donnees['prenom']) .'</div>';
	
elseif ($donnees['droits']==2)
		echo '<div class="modo">' .htmlspecialchars($donnees['prenom']) .'</div>';
	
	elseif ($donnees['droits']==3)
		echo '<div class="admin">' .htmlspecialchars($donnees['prenom']) .'</div>';
?>
<br/>
<p>Nom : <strong><?php echo strtoupper(htmlspecialchars($donnees['nom'])); ?></strong></p>
<p>Prénom : <strong><?php echo htmlspecialchars($donnees['prenom']); ?></strong></p>
<p>Date de naissance : <strong><?php echo $donnees['date_naissance_fr']; ?></strong></p>
<p>Localisation : <strong><?php echo $donnees['departement']; ?></strong></p>

<?php
	//adresse mail visible uniquement pour les membres de l'asso et des admins
	if($_SESSION['droits']>1)
	{
	?>
	<p>Adresse email : <strong><?php echo htmlspecialchars($donnees['email']); ?></strong></p>
	<?php
	}
	?>
	
<p><img src="images/droits.gif" alt="" /> Statut : <strong>
<?php
//affichage du statut avec couleurs
if ($donnees['droits']==1)
	echo '<span class="vert">Simple membre</span>';
	
elseif ($donnees['droits']==2)
		echo '<span class="bleu">Membre LEA - Modérateur</span>';
	
	elseif ($donnees['droits']==3)
		echo '<span class="rouge">Administrateur</span>';

?>
</strong></p>
<p>Date d'inscription : <strong><?php echo $donnees['date_inscription_fr']; ?></strong></p>



<?php
//Affichage du panneau de contrôle pour modifier les droits du membre

//EXPLICATION DES 4 CONDITIONS
//1 panneau de contrôle non accessible aux simples membres
//2 on ne peut pas non plus toucher au compte d'un administrateur
//3 cependant tout est accessible pour mon compte admin perso, je suis secrètement un super opérateur
//4 on ne peut pas modifier son propre compte via cette page
if( ( ($_SESSION['droits']>1 && $donnees['droits']<3) OR ($_SESSION['id']==1) ) AND ($_SESSION['id']!=$donnees['id']) )
{
?>
<br/><br/>

<fieldset class="modo">
<legend>Panneau de contrôle</legend>
<form method="post" action="pages/scripts/intervention_admin_script.php?id=<?php echo $donnees['id']; ?>">
<p><label for="action" class="label">Modifier les droits : </label>
	<select name="action" id="action">
			<optgroup label="Statut du membre">
			<option value="1">Simple membre</option>
			<option value="2">Membre de l'association</option>
			<?php
			//donner des droits d'admin est réservé aux admins
			if($_SESSION['droits']>2)
				echo '<option value="3">Administrateur</option>'; ?>
			</optgroup>
			<?php
			//l'option de suppression est réservée aux admins
			if($_SESSION['droits']>2)
			{
				echo '<optgroup label="Compte">';
				echo '<option value="4">Supprimer le compte</option>';
				echo '</optgroup>';
			}
			?>
	</select></p>
	
<p align="center"><input type="submit" value="Modifier"/> <img src="images/modifier.gif" alt="" /></p>
</form>

<?php
}
?>

</div>
</section>
