<?php

/* require_once 'inc/functions.php'; */

/* session_start(); */

?>
<?php $title = 'Mon blog';
?>

<?php ob_start();?>


<h1>S'inscrire</h1>

<?php if (isset($_SESSION['errors'])): ?>

    <div class="alert alert-danger">


        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>

            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?=$error;?></li>
            <?php endforeach;?>
        </ul>

    </div>

<?php endif;
unset($_SESSION['errors']);?>

<form class="form"action="index.php?action=newUser" method="POST">

    <div class="form-group">

        <label for="">Pseudo</label>

        <input type="text" name="username" class="form-control" required/>

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

    </div>

    <div class="form-group">

        <label for="">Email</label>

        <input type="email" name="email" class="form-control" required/>

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

    </div>

    <div class="form-group">

        <label for="">Mot de passe</label>

        <input type="password" name="password" class="form-control" required/>

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

    </div>

    <div class="form-group">

        <label for="">Confirmez votre mot de passe</label>

        <input type="password" name="password_confirm" class="form-control" required/>

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>

</form>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
