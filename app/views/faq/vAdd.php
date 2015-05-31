<form method="post" action="faqs/update">
<fieldset>
<legend>Ajouter/modifier un article</legend>
<div class="alert alert-info">Article : <?php echo $article->toString()?></div>
<div class="form-group">

	<select name="idCategorie" class="form-control">
	<?php echo $listCat;?>
	</select>

	<input type="hidden" name="id" value="<?php echo $article->getId()?>">
	<input type="text" name="titre" value="<?php echo $article->getTitre()?>" placeholder="Entrez un titre" class="form-control">
	<textarea name="contenu" class="form-control"> <?php echo $article->getContenu() ?> </textarea>

	<?php echo "<br> Utilisateur : <br />";?>
	<input class="form-control" type="text" readonly value="<?php echo Auth::getUser()?>" style="width:25%;"> <!-- affiche l'utilisateur connecté actuellement en dessous du cKEditor -->

	<?php echo "Date de création : <br />";?>
	<input class="form-control" type="text" readonly value="<?php echo $article->getDateCreation()?>" style="width:25%;"> <!-- affiche l'heure de création de l'article de la FAQ -->

	<?php echo "Version : <br />";?>
	<input class="form-control" type="text" readonly value="<?php echo $article->getVersion()?>" style="width:25%;"> <!-- affiche la version de l'article de la FAQ -->

</div>

<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>faqs">Annuler</a>
</div>
</fieldset>
</form>

