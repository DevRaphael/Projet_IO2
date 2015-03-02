<section>
<?php

if( (isset($_SESSION['droits'])) &&($_SESSION['droits']>1) )
{
global $bdd;

$requete = $bdd->prepare('DELETE FROM news WHERE id = ?');						
$requete->execute(array($_GET['id']));
$requete->closeCursor();


echo '<p><img src="images/reussite.gif" alt="" />Article supprimé</p>';
}
else
	echo '<p class="rouge"><img src="images/interdit.gif" alt="" /> Accès refusé</p>';
?>
</section>