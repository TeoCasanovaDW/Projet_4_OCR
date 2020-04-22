<?php 

$title = 'Connexion Administrateur';

$style = 'rel="stylesheet" type="text/css" href="public/css/styleConnexionAdminView.css"';

ob_start();

?>

<h2>Page de connexion</h2>

<form id="formAdminConnect" action="index.php?action=adminConnect" method="post">
	
	<label>Identifiant :</label>
	<input type="text" name="user">
	<label>Mot de passe :</label>
	<input type="password" name="password">
	<input type="submit" name="valider">

</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>