<?php $title = 'Mon blog';?>

<?php ob_start();?>


<h1>Mot de pass oublié</h1>

<form class="form w-50" action="index.php?action=forget" method="POST">

<div class="form-group">

    <label for="">Email</label>

    <input type="email" name="mail" class="form-control" required/>

    <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
    </div>

</div>


<button type="submit" class="btn btn-primary">Envoyer</button>

</form>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>

