<section>
<span class="page-titre">Actualité :</span>

<?php
//affichage du lien "nouvel article" pour les membres de l'asso et admins
	if( isset($_SESSION['droits']) && $_SESSION['droits']>1 )
	{
	echo '<div id="nouvel-article"><a href="index.php?page=nouvel_article" class="lien-profil">
	<img src="images/nouvel_article.gif" alt="" /> <span class="moyen">Nouvel article</span></a></div>';
	}

	
global $bdd;

//importation des articles depuis la base de données et du nom de l'auteur via une jointure de table
$requete = $bdd->query('SELECT comptes_membres.id, comptes_membres.prenom, news.id AS news_id, id_auteur, 
						DATE_FORMAT(date_publication, \'%d/%m/%Y\') AS date_publication, 
						titre, article, id_modificateur, DATE_FORMAT(date_modif, \'%d/%m/%Y\') AS date_modif
						FROM comptes_membres
						INNER JOIN news
						ON news.id_auteur = comptes_membres.id 
						ORDER BY news.id DESC 
						LIMIT 0, 5');
										
// Affichage des articles
while ($donnees = $requete->fetch())
{
	echo '<article><div class="cadre-article">';
	echo '<span class="titre-article"><a href="index.php?page=archives&amp;id=' .$donnees['news_id'] .'" class="lien-profil">' .htmlspecialchars($donnees['titre']) .'</a></span>';
	

	//si on est connecté, on peut cliquer sur l'auteur et voir son profil
	//on peut aussi cliquer sur le reste de la ligne pour accéder à la page de l'article
	if(isset($_SESSION['droits']))
		echo '<br/><div class="date-msg"><span class="gris"><a href="index.php?page=archives&amp;id=' .$donnees['news_id'] .'" class="auteur"><img src="images/publication.gif" alt="" />Publié par </a>
		<a href="index.php?page=voirprofil&amp;id=' .$donnees['id_auteur'] .'" class="auteur">' .htmlspecialchars($donnees['prenom']) .'</a>
		<a href="index.php?page=archives&amp;id=' .$donnees['news_id'] .'" class="auteur"> le ' .$donnees['date_publication'] .'</a></span></div>';
	else
		echo '<br/><div class="date-msg"><span class="gris"><a href="index.php?page=archives&amp;id=' .$donnees['news_id'] .'" class="auteur">
		<img src="images/publication.gif" alt="" />Publié par ' .htmlspecialchars($donnees['prenom']) .' le ' .$donnees['date_publication'] .'</a></span></div>';
		
	echo '<hr />';
	
	//traitement de l'article à travers plusieurs fonctions
	$article = stripslashes($donnees['article']);
    $article = htmlspecialchars($article);
    $article = nl2br($article);
     
    //on met en place le BBcode 
    $article = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $article);
	$article = preg_replace('#\[u\](.+)\[/u\]#isU', '<span class="souligne">$1</span', $article);
    $article = preg_replace('#\[i\](.+)\[/i\]#isU', '<span class="italique">$1</span>', $article);
    $article = preg_replace('#\[color=(red|green|blue)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $article);
    $article = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $article);
	$article = preg_replace('#([a-z0-9._/-]+@[a-z0-9._/-]+)#i', '<a href="mailto:$0">$0</a>', $article);
	$article = preg_replace('#\[img\](.+)\[/img\]#isU', '<img src="images/$1" alt=""/>', $article);
	$article = preg_replace('#\[center\](.+)\[/center\]#isU', '<p align="center">$1</p>', $article);
	$article = preg_replace('#\[left\](.+)\[/left\]#isU', '<span class="left">$1</span>', $article);
 
	//Et on affiche le contenu de l'article
	echo '<div class="previsualisation-article">' .$article .'</div>';
	
	//si l'article est trop long, on affiche un lien vers l'article complet
	if(strlen($donnees['article'])>1170)
	{
	echo '<p><a href="index.php?page=archives&amp;id=' .$donnees['news_id'] .'" class="auteur">
			...<br/><br/> <u>Lire la suite de l\'article</u></a></p>';
	}
	
	//numéro de l'article avec lien vers celui-ci
	echo '<div class="date-msg2"><span class="gris">
			<a href="index.php?page=archives&amp;id=' .$donnees['news_id'] .'" class="auteur">' . 
			'#' .$donnees['news_id'] .'</a></span></div>';
			
	
	//en cas de modification :
	if($donnees['id_modificateur']!=0)
	{
	//importation du nom du modificateur
	$requete2 = $bdd->prepare('SELECT comptes_membres.id, prenom, id_modificateur FROM comptes_membres
						INNER JOIN news
						ON news.id_modificateur = comptes_membres.id
						WHERE id_modificateur = ?');
	$requete2->execute(array($donnees['id_modificateur']));
	$donnees2 = $requete2->fetch();
	
	//affichage des infos de modifications
	echo '<span class="modif"><img src="images/modification.gif" alt="" /> modifié par ' .htmlspecialchars($donnees2['prenom']) .' le ' .$donnees['date_modif'] .'</span>';
	
	$requete2->closeCursor();
	}
	
	echo '</div></article>';
}

$requete->closeCursor();

?>


</section>
