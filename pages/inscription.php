
<section>
	<form method="post" action="pages/scripts/inscription_script.php">
		<fieldset>
			<legend>Inscription</legend>
				<?php
				if( isset($_GET['erreur']) AND ($_GET['erreur']==1))
					echo '<p class="champs">** Erreur, l\'identifiant que vous avez saisi existe déjà dans notre base de données. **</p><br/>';
				?>
				<?php
				if( isset($_GET['erreur']) AND ($_GET['erreur']==2))
					echo '<p class="champs">** Erreur, l\'email que vous avez saisi existe déjà dans notre base de données. **</p><br/>';
				?>
				
			<p>
				<label for="identifiant">Identifiant : </label>
				<input type="text" name="identifiant" id="identifiant" required size="30"/><span class="champs"> *</span></p>
			<p>
				<label for="nom">Nom : </label>
				<input type="text" name="nom" id="nom" required size="30"/><span class="champs"> *</span></p>
			<p>
				<label for="prenom">Prénom : </label>
				<input type="text" name="prenom" id="prenom" required size="30"/><span class="champs"> *</span></p>
			<p>
				<label for="date_naissance">Date de naissance : </label>
				<input type="date" name="date_naissance" id="date_naissance" placeholder="aaaa-mm-jj" min="1930-01-01" max="2009-12-31"/></p>
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
				<input type="email" name="email" id="email" required size="40"/><span class="champs"> *</span></p>
				
			<table align="center">
							<tr><td><input type="submit" value="Envoyer" /> <img src="images/valider.gif" alt="" /></td>
								<td><input type="reset" value="Effacer" /> <img src="images/supprimer.gif" alt="" /></td>
							</tr>
			</table>
			

			<p class="champs"><br/>* champs obligatoires</p>
		</fieldset>
	</form>
</section>
