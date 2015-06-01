<form method="post" action="tickets/update">
	<fieldset>
		<legend>Créer/modifier un ticket</legend>
		<div class="form-group">

			<select name="idCategorie" class="form-control">
				<?php echo $listCat;?>
			</select>

			<select name="idType" class="form-control">
				<?php echo $listType;?>
			</select>

			<input type="hidden" name="id" value="<?php echo $ticket->getId() ?>">
			<input type="text" name="titre" value="<?php echo $ticket->getTitre() ?>" placeholder="Entrez un titre" class="form-control">

			<textarea name="description" class="form-control"> <?php echo $ticket->getDescription() ?> </textarea>

			<?php echo "Utilisateur : <br />";?>
			<input class="form-control" type="text" readonly value="<?php echo Auth::getUser() ?>" style="width:25%;"> <!-- affiche l'utilisateur connecté actuellement en dessous du cKEditor -->

			<?php echo "Date de création : <br />";?>
			<input class="form-control" type="text" readonly value="<?php echo $ticket->getDateCreation() ?>" style="width:25%;"> <!-- //affiche l'heure de création du ticket -->

			<?php echo "Statut : <br />";?>
			<?php
			if(!empty($ticket->getStatut()) and Auth::isAdmin()) {
				?>
			<select class="form-control" name="statut" style="width:25%;">
			<?php echo $listStatut; ?> <!-- charge la liste des statuts -->
			</select>
			<?php
			}
			else { // si statut vide (au moment de la création) on impose le statut nouveau en readonly -->
				?>
				<input class="form-control" type="text" name="statut" readonly value="Nouveau" style="width:25%;" />
			<?php
			}
			?>
		</div>

		<div class="form-group">
			<input type="submit" value="Valider" class="btn btn-default">
			<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>Tickets">Annuler</a>
		</div>
	</fieldset>
</form>

