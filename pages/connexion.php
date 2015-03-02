<section>
	<form method="post" action="pages/scripts/connexion_script.php">
		<fieldset>
			<legend>Connexion</legend>
			<p>
				<label for="identifiant">Identifiant : </label>
				<input type="text" name="identifiant" id="identifiant" required size="25"/></p>
			<p>
				<label for="motdepasse">Mot de passe : </label>
				<input type="password" name="mot_de_passe" id="motdepasse" required size="25"/></p>
			
			<p><input type="submit" value="Connexion" class="centrer" /></p>
			
			<br/>
			<p align="center" class="petit">
			<a href="index.php?page=inscription" class="lien-profil">S'inscrire</a> | 
			<a href="index.php?page=oubli_mdp" class="lien-profil">J'ai oublié mon mot de passe</a>
			</p>
		</fieldset>
	</form>
</section>
