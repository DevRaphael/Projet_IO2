<section>
<strong><a href="index.php?page=membres" class="lien-profil">Communauté</a> > <img src="images/stats.gif" alt="" />
<a href="index.php?page=statistiques" class="lien-profil">Statistiques :</a></strong><br/><br/>

<div id="cadre-page-membres">

<?php
//importation de mes fonctions
include("pages/scripts/fonctions.php"); 

afficherNbMembres();
afficherNbMembresStatut();
afficherNbMessagesForum();
afficherNbPublications();
echo '<br /> <p class="moyen"><strong>Activité des membres :</strong></p>';
afficherTableauStatistiques();
?>

</div>
</section>
