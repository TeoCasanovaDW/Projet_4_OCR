<?php 

$title = 'Mon blog';

$style = 'rel="stylesheet" type="text/css" href="public/css/styleListPostView.css"';

ob_start();

while ($data = $posts->fetch()) {
	
?>

<div class="news">

	<h3>
		<?= htmlspecialchars($data['title']); ?>			
	</h3>

	<div class="creation_date">
		le <?= $data['creation_date_fr']; ?>			
	</div>

	<p>
		<?= nl2br($data['content'])?>			
	</p>

	<a href="index.php?id=<?= $data['id']; ?>&amp;action=post">Commentaires</a>
</div>

<?php 

}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>