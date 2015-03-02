<header>
		<a href="index.php?page=news"><div id="header-img"></div></a>
		<span class="italique">
		<?php
			//affichage du prénom du membre
			if( isset($_SESSION['prenom']) )
				echo 'Bienvenue <a href="index.php?page=profil" class="lien-profil"><strong>' . htmlspecialchars($_SESSION['prenom']) . '</strong></a>';
			else
				echo 'Le journal étudiant';
		?>
		</span>

		<div id="liens-header">
		<div class="menu-haut"><a href="index.php?page=inscription">Inscription</a></div>
		<?php
		//affichage du bouton connexion/déconnexion
			if( isset($_SESSION['droits']) )
				echo ' <div class="menu-haut"><a href="index.php?page=deconnexion">Déconnexion</a></div> ' ;
			else 
				echo ' <div class="menu-haut"><a href="index.php?page=connexion">Connexion</a></div> ' ;
		?>
		</div>
		
</header>
<hr />
<br/>

