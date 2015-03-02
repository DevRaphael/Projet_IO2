<?php

//tableaux des pages valides
$page_publique_valide = array('news' => 'pages/news.php', 'presentation' => 'pages/presentation.php',
					'projets' => 'pages/projets.php', 'archives' => 'pages/archives.php', 
					'contacts' => 'pages/contacts.php', 'inscription' => 'pages/inscription.php',
					'connexion' => 'pages/connexion.php','inscription_fin' => 'pages/scripts/inscription_fin.php', 
					'erreur' => 'pages/erreur.php', 'oubli_mdp' => 'pages/scripts/oubli_mdp.php',
					'oubli_mdp_fin' => 'pages/scripts/oubli_mdp_fin.php', 'informations' => 'pages/informations.php',
					'a_propos' => 'pages/a_propos.php');
					
$page_privee_valide = array('forum' => 'pages/forum.php', 'membres' => 'pages/membres.php', 
					'profil' => 'pages/profil.php',	'profil_modifier' => 'pages/scripts/profil_modifier.php',
					'deconnexion' => 'pages/scripts/deconnexion.php', 'se_desinscrire' => 'pages/se_desinscrire.php', 
					'statistiques' => 'pages/statistiques.php',
					'evenements_prives' => 'pages/evenements_prives.php',
					'voirprofil' => 'pages/voirprofil.php', 'nouvel_article' => 'pages/nouvel_article.php',
					'modifier_article' => 'pages/scripts/modifier_article.php',
					'supprimer_article' => 'pages/scripts/supprimer_article.php');

//gestion du cas où l'attribut page n'a pas de valeur ou si la valeur ne correspond pas à une page valide
	if( (isset($_GET['page'])) && (isset($page_publique_valide[$_GET['page']])) )
	{
		include($page_publique_valide[$_GET['page']]);
	}
		elseif( (isset($_GET['page'])) && (isset($_SESSION['droits'])) && (isset($page_privee_valide[$_GET['page']])) )
		{
			//pages privées accessibles qu'aux membres connectés
			include($page_privee_valide[$_GET['page']]);
		}
		else
		{
			include("pages/news.php");
		}
		
?>