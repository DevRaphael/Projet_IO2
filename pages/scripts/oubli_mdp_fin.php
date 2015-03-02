<section>
<p><img src="images/reussite.gif" alt="" /> <strong>Identification réussie</strong></p>
<br/>
<div class="cadre-profil">
<p><label><strong>Identifiant : </strong></label> 
<?php 
//affichage des informations de connexion du compte, avec prise en charge de tentative de fraude
//ces données apparaissent une seule fois et disparaissent après actualisation, le mot de passe ne peut être retrouvé
	if( isset($_SESSION['identifiant']) )
		echo $_SESSION['identifiant'];
	else
		echo '<img src="images/interdit.gif" alt="" /> <span class="rouge">données protégées</span>';
?></p>

<p><label><strong>Mot de passe : </strong></label> 
<?php
if( isset($_SESSION['mot_de_passe']) )
	echo $_SESSION['mot_de_passe'];
else
	echo '<img src="images/interdit.gif" alt="" /> <span class="rouge">données protégées</span>';
?>
</p>
</div>
<br/>
<p>Veuillez bien noter et conserver ces informations.</p>
</section>
<?php
//les informations contenues dans la variable superglobale SESSION sont détruites dès que la page est chargée
session_destroy();
?>