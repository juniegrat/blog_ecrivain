<?php

/* require_once 'inc/functions.php'; */
/* session_start(); */

if (isset($_SESSION['auth'])) {

    header('location: index.php?action=listPosts');

    exit();

}

?>
<?php $title = 'Mon blog';?>

<?php ob_start();?>

<h1>Se connecter</h1>

<form class="form"action="index.php?action=login" method="POST">

    <div class="form-group">

        <label for="">Pseudo ou email</label>

        <input type="text" name="username" class="form-control" required/>

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

    </div>


    <div class="form-group">

        <label for="">
            Mot de passe <a href="index.php?action=forget">(J'ai oublié mon mot de passe)</a>
        </label>

        <input type="password" name="password" class="form-control" required/>

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="remember" value="1"/> Se souvenir de moi
        </label>
    </div>


    <button type="submit" class="btn btn-primary">Se connecter</button>


    <a href="index.php?action=register">Pas encore de compte ?</a>


</form>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>

