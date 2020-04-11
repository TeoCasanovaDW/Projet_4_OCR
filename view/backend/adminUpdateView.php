<?php 

$title = 'Administration';

$style = 'rel="stylesheet" type="text/css" href="public/css/styleAdminUpdateView.css"';

ob_start();

?>

<h2>Ancien billet :</h2>

<div class="news">

	<h3>
		<?= htmlspecialchars($displayPostToUpdate['title']) ?>			
	</h3>

	<div class="creation_date">
		<?= $displayPostToUpdate['creation_date_fr'] ?>
	</div>

	<p>
		<?= nl2br($displayPostToUpdate['content'])?>			
	</p>

</div>

<br><br><br><br>

<h2>Nouveau billet :</h2>

<div id="Update">
	
	<form id="formUpdatePost" action="index.php?action=updatePost&amp;post_id=<?= $displayPostToUpdate['id'] ?>" method="post">

		<label for="title">Titre :</label>
		<input type="text" name="titleUpdated"></input>
		<br><br>
		<label for="content">Contenu :</label>
		<input type="text" name="contentUpdated" class="mytextarea"></input>

		<input type="submit" name="valider">

	</form>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>