<section>
<strong><a href="index.php?page=membres" class="lien-profil">Communauté</a> > <img src="images/forum.gif" alt="" /> 
<a href="index.php?page=forum" class="lien-profil">Forum :</a></strong><br/><br/>

<div id="cadre-forum1">
	<form method="post" action="pages/scripts/forum_post.php">
			<p>
				<label for="message" class="label">Message : </label>
				<textarea name="message" id="message" required ></textarea></p>
			<p>
			<input type="submit" value="Envoyer" class="centrer" /></p>
	</form>
</div>

<div id="cadre-forum2">
		
		<table align="center">
		<tr><td>
			<form method="post" action="index.php?page=forum#cadre-forum2">
			<input type="submit" value="Actualiser" /> <img src="images/actualiser.gif" alt="" />
			</form></td>
		
		<?php
		//affichage de l'option SUPPRIMER uniquement pour les administrateurs
		if( $_SESSION['droits']==3)
		{
		?>
		<td>
			<form method="post" action="pages/scripts/forum_effacer.php">
			<input type="submit" value="Supprimer les messages" /> <img src="images/supprimer.gif" alt="" />
			</form>
		</td>
		<?php
		}
		?>
		</tr></table>
<br/>

<?php

global $bdd; 

//importation des messages de la base de données
$requete = $bdd->query('SELECT mini_chat.id id_message, DATE_FORMAT(date_message, \'%d/%m/%Y à %Hh%i\') AS date_message_fr, 
						message, id_auteur, comptes_membres.id, nom, prenom
						FROM comptes_membres
						INNER JOIN mini_chat
						ON id_auteur = comptes_membres.id
						ORDER BY mini_chat.id DESC 
						LIMIT 0, 20');


// Affichage des messages
while ($donnees = $requete->fetch())
{
	//alternance de la couleur de fond 1 message sur 2
    if ($donnees['id_message']%2==0)
		echo '<p><div class="msg-forum2"><strong>' .htmlspecialchars($donnees['prenom']) .' ' .htmlspecialchars($donnees['nom']) . '</strong> : ' .htmlspecialchars($donnees['message']) . '<br/><div class="date-msg"> posté le ' . $donnees['date_message_fr'] . '</div></div></p>';
	else
		echo '<p><div class="msg-forum1"><strong>' .htmlspecialchars($donnees['prenom']) .' ' .htmlspecialchars($donnees['nom']) . '</strong> : ' .htmlspecialchars($donnees['message']) . '<br/><div class="date-msg"> posté le ' . $donnees['date_message_fr'] . '</div></div></p>';
}

$requete->closeCursor();
 
?>

</div>
</section>
