<?php

$title = 'Mon blog';

$style = 'rel="stylesheet" type="text/css" href="public/css/style.css"';

ob_start();

?>

<div><?= $errorMessage ?></div>

<?php $content = ob_get_clean(); ?>

<?php require('frontend/template.php'); ?>
