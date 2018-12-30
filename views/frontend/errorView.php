<?php $title = 'Mon blog';?>

<?php ob_start();?>


<h1>Page introuvable</h1>

<p>L'URL indiqué ne correspond à aucune page, essayez de rentrer une URL valide ou cliquez ici pour retourner à <a href="index.php">l'Acceuil</a></p>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>

