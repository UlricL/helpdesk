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
	<?php echo "Utilisateur : <br />";?>
	<input type="text" disabled value="<?php echo Auth::getUser()?>"> <?php //affiche l'utilisateur connecté actuellement en dessous du cKEditor ?>
	<?php echo "<br />Date de création : <br />";?>
	<input type="text" disabled value="<?php echo $article->getDateCreation()?>"> <?php //affiche l'heure de création de l'article de la FAQ ?>
	<?php echo "<br />Version : <br />";?>
	<input type="text" disabled value="<?php echo $article->getVersion()?>"> <?php //affiche la version de l'article de la FAQ ?>

	<?php
	/*affiche l'heure de création de l'article de la FAQ (requête SQL à la BDD)
	$bdd=mysqli_connect("localhost","root","","helpdesk"); // connection au serv' SQL
	$result = mysqli_query($bdd, "SELECT `dateCreation` FROM `faq`"); // la requête pour obtenir l'heure
	$row = mysqli_fetch_row($result);
	$date = date_create($row[0]);
	echo "<br />Date de création :<br />";
	echo date_format($date, 'Y-m-d H:i:s'); // format de la date
	$article->getDateCreation();*/
	?>

</div>

<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>users">Annuler</a>
</div>
</fieldset>
</form>

