<form method="post" action="tickets/update">
	<fieldset>
		<legend>Créer/modifier un ticket</legend>
		<div class="form-group">

			<select name="idCategorie" class="form-control">
				<?php echo $listCat;?>
			</select>

			<select name="idType" class="form-control">
			<option disabled selected>Type</option>
			<?php foreach($ticketTypes as $type => $libelle) {  ?>
				<option value="<?php echo $type; ?>"><?php echo $libelle; ?></option>
			<?php } ?>
			</select>

			<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
			<input type="text" name="titre" value="<?php echo $ticket->getTitre()?>" placeholder="Entrez un titre" class="form-control">
			<textarea name="description" class="form-control"> <?php echo $ticket->getDescription() ?> </textarea>

			<?php echo "Utilisateur : <br />";?>
			<input type="text" disabled value="<?php echo Auth::getUser()?>"> <?php //affiche l'utilisateur connecté actuellement en dessous du cKEditor ?>

			<?php echo "<br />Date de création : <br />";?>
			<input type="text" disabled value="<?php echo $ticket->getDateCreation()?>"> <?php //affiche l'heure de création du ticket ?>

			<?php echo "<br />Statut : <br />";?>
			<input type="text" disabled value="<?php echo $ticket->getStatut()?>"> <?php //affiche le statut du ticket ?>

		</div>

		<div class="form-group">
			<input type="submit" value="Valider" class="btn btn-default">
			<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>users">Annuler</a>
		</div>
	</fieldset>
</form>

