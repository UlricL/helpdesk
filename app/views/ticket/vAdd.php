<form method="post" action="tickets/update">
	<fieldset>
		<legend>Créer un ticket</legend>
		<div class="alert alert-info">Article : <?php echo $ticket->toString()?></div>
		<div class="form-group">

			<select name="idCategorie" class="form-control">
				<?php echo $listCat;?>
			</select>

			<select name="idType" class="form-control">
				<?php echo $TypeTicket;?>
			</select>

			<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
			<input type="text" name="titre" value="<?php echo $ticket->getTitre()?>" placeholder="Entrez un titre" class="form-control">
			<textarea name="contenu" class="form-control"> <?php echo $ticket->getContenu() ?> </textarea>

			<?php echo "Utilisateur : <br />";?>
			<input type="text" disabled value="<?php echo Auth::getUser()?>"> <?php //affiche l'utilisateur connecté actuellement en dessous du cKEditor ?>

			<?php echo "<br />Date de création : <br />";?>
			<input type="text" disabled value="<?php echo $ticket->getDateCreation()?>"> <?php //affiche l'heure de création du ticket ?>

			<?php echo "<br />Version : <br />";?>
			<input type="text" disabled value="<?php echo $ticket->getVersion()?>"> <?php //affiche la version du ticket ?>

		</div>

		<div class="form-group">
			<input type="submit" value="Valider" class="btn btn-default">
			<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>users">Annuler</a>
		</div>
	</fieldset>
</form>

