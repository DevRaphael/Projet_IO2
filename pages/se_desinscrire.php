<section>
<strong><a href="index.php?page=membres" class="lien-profil">Communauté</a> > <img src="images/vigilance.gif" alt="" /> 
<a href="index.php?page=se_desinscrire" class="lien-profil">Se désinscrire :</a></strong><br/><br/>

<div class="cadre-page">

<?php
//impossibilité de supprimer son compte pour les admins
if( $_SESSION['droits']==3)
{
echo '<p class="rouge"><img src="images/interdit.gif" alt="" /> <strong>Les administrateurs ne peuvent pas supprimer leur compte.</strong></p>';
}
else
{
?>

<p class="rouge"><img src="images/attention.gif" alt="" /> Attention,</p>
<p>Cette action est irrémédiable, elle supprimera définitivement votre compte et toutes les données qui y sont associées.</p>
<p>Êtes-vous sûr de vouloir continuer ?</p>

<script>
function confirmation(id){
	document.getElementById(id).style.display='block';
}
</script>
	
<form><input onclick="confirmation('cache')" type="button" value="Oui" class="centrer"/></form>

		<!-- Gestion des utilisateurs qui n'ont pas activé JavaScript -->
		<noscript>
		<p><br/><form action="pages/scripts/desinscription_script.php">
			<input type="submit" value="Se Désinscrire" class="centrer"/></form>
		</noscript>
		
		<div id="cache">
			<p><br/><form action="pages/scripts/desinscription_script.php">
			<input type="submit" value="Se Désinscrire" class="centrer"/></form></p>
		</div>

<?php
}
?>

</div>
</section>
