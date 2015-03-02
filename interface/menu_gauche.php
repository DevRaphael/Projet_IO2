<nav>
	<div id="menu-gauche">
		<div id="date">
			<p class="centrer-txt"><span class="petit">Aujourd'hui :</span><br/><strong>
			<?php
			//paramétrage de la date sur le fuseau horaire de Paris, puis conversion en format français avec le nom du mois
			date_default_timezone_set('Europe/Paris');
			$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
			$datefr = date("d")." ".$mois[date("n")]." ".date("Y");
			echo $datefr;
			?> 
			</strong></p>
		</div>
	
	<ul>
		<li><a href="index.php?page=news">Accueil</a></li>
		<li><a href="index.php?page=presentation">Présentation</a></li>
		<li><a href="index.php?page=informations">Informations</a></li>
		<li><a href="index.php?page=projets">Projets</a></li>
		<li><a href="index.php?page=archives">Archives</a></li>
		<li><a href="index.php?page=contacts">Contacts</a></li>
		<li><a href="index.php?page=a_propos">À propos</a></li>
	</ul>
	
	<p><img src="images/journal.gif" alt="" class="centrer"/></p>
	
	</div>
</nav>

