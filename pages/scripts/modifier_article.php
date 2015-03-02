<?php

if($_SESSION['droits']>1)
{

global $bdd;

$requete = $bdd->prepare('SELECT id, titre, article FROM news WHERE id = ?');
$requete->execute(array($_GET['id']));
 
$donnees = $requete->fetch();
?>
<section>

<p><img src="images/nouvel_article.gif" alt="" /> <strong>Modifier un article :</strong></p>
<br/>

<form method="post" action="pages/scripts/modifier_article_script.php" />

<p><label for="id" class="label-nouvel-article">#id :</label>
<input type="text" name="id" id="id" value="<?php echo $_GET['id']; ?>" required size="3" />

<p><label for="titre" class="label-nouvel-article">Titre :</label>
<textarea name="titre" id="titre" class="textarea-titre" required ><?php echo htmlspecialchars($donnees['titre']); ?></textarea></p>

<p><label for="article" class="label-nouvel-article">Article :</label>
<textarea name="article" id="article" class="textarea-article" required ><?php echo htmlspecialchars($donnees['article']); ?></textarea></p>

<p align="center" class="petit"><span class="gris">Balises disponibles : [b]<strong>gras</strong>[/b], 
[i]<span class="italique">italique</span>[/i], [u]<span class="souligne">souligné</span>[/u]
<br/> [color=red][/color], [img][/img], [center][/center], [left][/left]</span></p>

<br/><br/>
<p align="center"><input type="submit" value="Enregistrer"/> <img src="images/valider.gif" alt="" /></p>

</form>

</section>
<?php
}
else
{
echo '<section><p class="rouge"><img src="images/interdit.gif" alt="" /> Accès refusé</p></section>';
}
?>