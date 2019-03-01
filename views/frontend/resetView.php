
<?php

/* session_start(); */

/* require 'inc/functions.php'; */

?>

<?php $title = 'Mon blog';?>

<?php ob_start();?>

<h1>Réinitialisation du mot de passe</h1>

<form class="form"action='index.php?action=reset&id=<?=$id;?>&token=<?=$token;?>'  method="POST">
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Nouveau de mot de passe">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password_confirm" placeholder="Confirmez le nouveau mot de passe">
    </div>

    <button class="btn btn-primary">Réinitialiser le mot de passse</button>
</form>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>


