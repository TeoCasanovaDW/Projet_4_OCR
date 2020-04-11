<?php

$title = 'Mon blog';

$style = 'rel="stylesheet" type="text/css" href="public/css/stylePostView.css"';

ob_start();

?>

<div class="news">

	<h3>
		<?= htmlspecialchars($post['title']) ?>			
	</h3>

	<div class="creation_date">
		<?= $post['creation_date_fr'] ?>
	</div>

	<p>
		<?= nl2br($post['content'])?>			
	</p>

	<a href="index.php?action=listPosts">Retour à la page d'acceuil</a>

</div>

<h2>Commentaires</h2>

	<div id="comments">

	<?php
		while ($comment = $comments->fetch()){
	?>
		<p>
			<?= htmlspecialchars($comment['author']) . ' : ' . htmlspecialchars($comment['comment']) . ' le :' . $comment['comment_date_fr'] ?>
		</p>
		
		<a href="index.php?action=signaler&amp;comment_id=<?= $comment['id'] ?>">(Signaler)</a>

	<?php
	}
	?>

	</div>

	<h2>Ajouter un commentaire</h2>

<form id="formAddComment" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur : </label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire :</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>


	