<section>
<strong><a href="index.php?page=membres" class="lien-profil">Communauté</a> > <img src="images/communaute.gif" alt="" />
<a href="index.php?page=membres" class="lien-profil">Liste des membres :</a></strong><br/><br/>

<div id="cadre-page-membres">
<p align="center"><img src="images/lea.png" alt="" /></p>

<?php
//importation de ma fonction d'affichage de tableaux
include("pages/scripts/fonctions.php"); 

afficherNbMembres();
echo '<br/>';
afficherTableauMembres();
?>

</div>
</section>
