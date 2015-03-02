<section>
	<form method="post" action="pages/scripts/oubli_mdp_script.php">
		<fieldset>
			<legend>Récupérer son mot de passe</legend>
			<br/>
			<p>Veuillez renseigner les informations suivantes :</p><br/>
			<p>
				<label for="identifiant">Identifiant : </label>
				<input type="text" name="identifiant" id="identifiant" required size="25"/></p>
			<p>
				<label for="date_naissance">Date de naissance : </label>
				<input type="date" name="date_naissance" id="date_naissance" placeholder="aaaa-mm-jj" min="1930-01-01" max="2009-12-31" /></p>
			<p>
				<label for="email">Adresse email : </label>
				<input type="mail" name="email" id="email" required size="35"/></p>
			
			<p align="center"><input type="submit" value="Envoyer"/> <img src="images/valider.gif" alt="" /></p>
			
		</fieldset>
	</form>
</section>