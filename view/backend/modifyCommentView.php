<?php

$title = 'Modification commentaire';

$style = 'rel="stylesheet" type="text/css" href="public/css/styleModifyCommentView.css"';

ob_start();

?>
<br>
<h3 class="modifyCommenth3">Ancien commentaire :</h3><br>
<p id="ancienCom"><?= htmlspecialchars($old_comment['comment']); ?></p><br><br>



<h3 class="modifyCommenth3">Nouveau commentaire :</h3><br>
<form id="formNewComment" action="index.php?action=editComment&amp;comment_id=<?= $_GET['comment_id'] ?>" method="post">
	
	<textarea id="newComment" name="newComment"></textarea>
	<input type="submit" name="valider" value="Valider" id="valider">

</form>


<?php $content = ob_get_clean(); ?>

<?php require('./view/frontend/template.php'); ?>