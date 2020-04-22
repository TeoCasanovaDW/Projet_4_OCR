<?php 

$title = 'Administration';

$style = 'rel="stylesheet" type="text/css" href="public/css/styleAdminView.css"';

ob_start();

?>

<h2>Section Administrateur</h2>

<div id="Create">

	<h3 class="sous-titre">Créer un post</h3>

	<form id="formCreatePost" action="index.php?action=createPost" method="post">

		<label for="title">Titre :</label>
		<input type="text" name="titleCreated"></input>
		<br>
		<label for="content">Contenu :</label>
		<input type="text" name="contentCreated" class="mytextarea"></input>
		<br>
		<input type="submit" name="valider">

	</form>

</div>

<?php
while ($data = $posts->fetch()) {
?>

<article class="news">

	<h3>
		<?= htmlspecialchars($data['title']) ?>			
	</h3>

	<div class="creation_date">
		<?= $data['creation_date_fr'] ?>
	</div>

	<p>
		<?= nl2br($data['content'])?>			
	</p>
		
	<a href="index.php?action=adminUpdatePage&amp;post_id=<?= $data['id'] ?>">Mettre le billet à jour</a>
	<a href="index.php?action=deletePost&amp;post_id=<?= $data['id'] ?>">Supprimer le billet</a>

</article>

<?php
}
?>

<h3 class="sous-titre">Commentaires</h3>

<div id="comments">

	<?php
	while ($comment = $AllComments->fetch()){
		if ($comment['report'] > 0) {
	?>

		<h4>Billet n°<?= htmlspecialchars($comment['post_id']) ?> : </h4>

		<p>
			<?= 'De <strong>' . htmlspecialchars($comment['author']) . '</strong> le ' . $comment['comment_date_fr'] . ' :<br><p id="com">' . htmlspecialchars($comment['comment']) . '</p>'?>
		</p>
		<a href="index.php?action=commentEditor&amp;comment_id=<?= $comment['id'] ?>">(Modifier)</a>
		<a href="index.php?action=deleteComment&amp;comment_id=<?= $comment['id'] ?>">(Supprimer)</a>
		<a href="index.php?action=removeReport&amp;comment_id=<?= $comment['id'] ?>">(Enlever le signalement)</a>
		

	<?php
		}
	}
	?>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>