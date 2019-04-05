
<?php

/* session_start(); */

/* require 'inc/functions.php'; */

?>

<?php $title = 'Mon blog';?>

<?php ob_start();?>


<h1>Bonjour <?=$_SESSION['auth']->username;?></h1>

<form class="form w-50" action="index.php?action=account" method="POST">
    <div class="form-group">

        <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe">

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

    </div>

    <div class="form-group">

        <input class="form-control" type="password" name="password_confirm" placeholder="Confirmez le nouveau mot de passe">

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

    </div>

    <button class="btn btn-primary">Changer mon mot de passe</button>
</form>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>


