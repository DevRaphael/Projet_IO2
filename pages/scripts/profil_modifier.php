<section>
	<form method="post" action="pages/scripts/profil_modifier_script.php">
		<fieldset>
			<legend>Modification du profil</legend>
			<p>
				<label>Identifiant : </label> <?php echo $_SESSION['identifiant']; ?></p>
			<p>
				<label for="nom">Nom : </label>
				<input type="text" name="nom" id="nom" required size="30"  value="<?php echo $_SESSION['nom']; ?>"/><span class="champs"> *</span></p>
			<p>
				<label for="prenom">Prénom : </label>
				<input type="text" name="prenom" id="prenom" required size="30" value="<?php echo $_SESSION['prenom']; ?>"/><span class="champs"> *</span></p>
			<p>
				<label for="date_naissance">Date de naissance : </label>
				<input type="date" name="date_naissance" id="date_naissance" placeholder="aaaa-mm-jj" min="1930-01-01" max="2009-12-31"  value="<?php echo $_SESSION['date_naissance_us']; ?>"/></p>
			<p>
				<label for="departement">Département : </label>
					<select name="departement" id="departement">
						<optgroup label="Île-de-France">
						<option value="75 - Paris">75 - Paris</option>
						<option value="77 - Seine et Marne">77 - Seine et Marne</option>
						<option value="78 - Yvelines">78 - Yvelines</option>
						<option value="91 - Essonne">91 - Essonne</option>
						<option value="92 - Hauts de Seine">92 - Hauts de Seine</option>
						<option value="93 - Seine Saint Denis">93 - Seine Saint Denis</option>
						<option value="94 - Val de Marne">94 - Val de Marne</option>
						<option value="95 - Val d'Oise">95 - Val d'Oise</option>
						</optgroup>
						<optgroup label="Autre">
						<option value="45 - Loiret (Orléans)">45 - Loiret (Orléans)</option>
						<option value="49 - Maine et Loire">49 - Maine et Loire</option>
						<option value="Autre">Autre</option>
						</optgroup>
					</select></p>
			<p>
				<label for="email">Email: </label>
				<input type="email" name="email" id="email" required size="40"/  value="<?php echo $_SESSION['email']; ?>"><span class="champs"> *</span></p>
			<p align="center"><input type="submit" value="Enregistrer" /> <img src="images/valider.gif" alt="" /></p>
			<p class="champs"><br/>* champs obligatoires</p>
		</fieldset>
	</form>
</section>
