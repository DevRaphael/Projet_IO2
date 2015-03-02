<section>
<strong><a href="index.php?page=membres" class="lien-profil">Communauté</a> > <img src="images/home.gif" alt="" />
<a href="index.php?page=profil" class="lien-profil">Profil :</a></strong><br/><br/>

<div class="cadre-profil">

<?php
//affichage du prénom avec la couleur du statut en fond
if ($_SESSION['droits']==1)
	echo '<div class="membre">' .htmlspecialchars($_SESSION['prenom']) .'</div>';
	
elseif ($_SESSION['droits']==2)
		echo '<div class="modo">' .htmlspecialchars($_SESSION['prenom']) .'</div>';
	
	elseif ($_SESSION['droits']==3)
		echo '<div class="admin">' .htmlspecialchars($_SESSION['prenom']) .'</div>';
?>
<br/>
<p>Identifiant : <strong><?php echo htmlspecialchars($_SESSION['identifiant']); ?></strong></p>
<p>Nom : <strong><?php echo strtoupper(htmlspecialchars($_SESSION['nom'])); ?></strong></p>
<p>Prénom : <strong><?php echo htmlspecialchars($_SESSION['prenom']); ?></strong></p>
<p>Date de naissance : <strong><?php echo $_SESSION['date_naissance_fr']; ?></strong></p>
<p>Localisation : <strong><?php echo $_SESSION['departement']; ?></strong></p>
<p>Adresse email : <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong></p>
<p><img src="images/droits.gif" alt="" /> Statut : <strong>
<?php
//affichage du statut avec couleurs
if ($_SESSION['droits']==1)
	echo '<span class="vert">Simple membre</span>';
	
elseif ($_SESSION['droits']==2)
		echo '<span class="bleu">Membre LEA - Modérateur</span>';
	
	elseif ($_SESSION['droits']==3)
		echo '<span class="rouge">Administrateur</span>';

?>
</strong></p>
<p>Date d'inscription : <strong><?php echo $_SESSION['date_inscription']; ?></strong></p>
<br/>
<form method="post" action="index.php?page=profil_modifier">
<p align="center"><input type="submit" value="Modifier" /> <img src="images/modifier.gif" alt="" /><br/></p>
</div>
</section>
