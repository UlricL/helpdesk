<form method="post" action="faqs/update">
<fieldset>
<legend>Ajouter/modifier un article</legend>
<div class="alert alert-info">Article : <?php echo $article->toString()?></div>
<div class="form-group">
	<select name="idCategorie" class="form-control">
	<?php echo $listCat;?>
	</select>
	<input type="hidden" name="id" value="<?php echo $article->getId()?>">
	<input type="text" name="titre" value="<?php echo $article->getTitre()?>" placeholder="Entrez un article" class="form-control">
	<textarea name="contenu" class="form-control"> <?php echo $article->getContenu() ?> </textarea>
	<input type="text" disabled value="<?php echo Auth::getUser()?>">


</div>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>users">Annuler</a>
	<?php /// echo date('d m Y H:i'); ?>
</div>
</fieldset>
</form>

