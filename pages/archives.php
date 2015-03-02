<section>
<span class="page-titre"><a href="index.php?page=archives" class="lien-profil">Archives :</a></span>

<?php

global $bdd;

//importation des articles depuis la base de données et du nom de l'auteur via une jointure de table
$requete = $bdd->query('SELECT id, DATE_FORMAT(date_publication, \'%d/%m/%Y\') AS date_publication, titre 
						FROM news ORDER BY id DESC LIMIT 0, 50');
			
//s'il n'y a pas d'argument GET, on affiche la liste des articles			
if(!isset($_GET['id']))
{			

echo '<div class="cadre-archives">';
echo '<span class="moyen"><strong>Liste des articles :</strong></span>';
echo '<br/><blockquote>';
		
// Affichage de la liste des articles
while ($donnees = $requete->fetch())
{
	echo '<a href="index.php?page=archives&amp;id=' .$donnees['id'] .'" class="auteur">' 
	.$donnees['date_publication'] .' : ' .htmlspecialchars($donnees['titre']) .'</a><br/>';
}

$requete->closeCursor();

echo '</blockquote></div>';

}
//sinon, on affiche l'article demandé en argument GET
else
{

$requete2 = $bdd->prepare('SELECT comptes_membres.id, comptes_membres.prenom, news.id AS news_id, id_auteur, 
						DATE_FORMAT(date_publication, \'%d/%m/%Y\') AS date_publication, 
						titre, article, id_modificateur, DATE_FORMAT(date_modif, \'%d/%m/%Y\') AS date_modif
						FROM comptes_membres
						INNER JOIN news
						ON news.id_auteur = comptes_membres.id
						WHERE news.id = ?');
						
$requete2->execute(array($_GET['id']));

$donnees2 = $requete2->fetch();

//cas où on taperait une id de news qui n'existe pas
if(!isset($donnees2['news_id']))
{
	header('Location: index.php?page=archives');
}

	echo '<article><div class="cadre-article-archives">';
	echo '<span class="titre-article"><a href="index.php?page=archives&amp;id=' .$donnees2['news_id'] .'" class="lien-profil">' .htmlspecialchars($donnees2['titre']) .'</a></span>';
	

	//si on est connecté, on peut cliquer sur l'auteur et voir son profil
	//on peut aussi cliquer sur le reste de la ligne pour accéder à la page de l'article
	if(isset($_SESSION['droits']))
		echo '<br/><div class="date-msg"><span class="gris"><a href="index.php?page=archives&amp;id=' .$donnees2['news_id'] .'" class="auteur"><img src="images/publication.gif" alt="" />Publié par </a>
		<a href="index.php?page=voirprofil&amp;id=' .$donnees2['id_auteur'] .'" class="auteur">' .htmlspecialchars($donnees2['prenom']) .'</a>
		<a href="index.php?page=archives&amp;id=' .$donnees2['news_id'] .'" class="auteur"> le ' .$donnees2['date_publication'] .'</a></span></div>';
	else
		echo '<br/><div class="date-msg"><span class="gris"><a href="index.php?page=archives&amp;id=' .$donnees2['news_id'] .'" class="auteur">
		<img src="images/publication.gif" alt="" />Publié par ' .htmlspecialchars($donnees2['prenom']) .' le ' .$donnees2['date_publication'] .'</a></span></div>';
		
	echo '<hr />';
	
	//traitement de l'article à travers plusieurs fonctions
	$article = stripslashes($donnees2['article']);
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
	echo '<p>' .$article .'</p>';
	
	//en cas de modification :
	if($donnees2['id_modificateur']!=0)
	{
	//importation du nom du modificateur
	$requete3 = $bdd->prepare('SELECT comptes_membres.id, prenom, id_modificateur FROM comptes_membres
						INNER JOIN news
						ON news.id_modificateur = comptes_membres.id
						WHERE id_modificateur = ?');
	$requete3->execute(array($donnees2['id_modificateur']));
	$donnees3 = $requete3->fetch();
	
	//affichage des infos de modifications
	echo '<span class="modif"><img src="images/modification.gif" alt="" /> modifié par ' .htmlspecialchars($donnees3['prenom']) .' le ' .$donnees2['date_modif'] .'</span>';
	
	$requete3->closeCursor();
	}
	
	//actions modifier,supprimer accessibles qu'aux modos et admins
	if( (isset($_SESSION['droits'])) &&($_SESSION['droits']>1) )
	{
	echo '<span class="gris"><div class="date-msg">
			<a href="index.php?page=modifier_article&amp;id=' .$donnees2['news_id'] .'" class="auteur">Modifier </a><img src="images/modifier.gif" alt="" />
			<a href="index.php?page=supprimer_article&amp;id=' .$donnees2['news_id'] .'" class="auteur">Supprimer </a><img src="images/supprimer.gif" alt="" />
			<a href="index.php?page=archives&amp;id=' .$donnees2['news_id'] .'" class="auteur">' . 
			'#' .$donnees2['news_id'] .'</a></div></span>';
	}
	else
	{
	echo '<span class="gris"><div class="date-msg">
			<a href="index.php?page=archives&amp;id=' .$donnees2['news_id'] .'" class="auteur">' . 
			'#' .$donnees2['news_id'] .'</a></div></span>';
	}
	
	echo '</div></article>';
}
?>

</section>
