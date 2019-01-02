<?php $title = 'Mon blog';?>

<?php ob_start();?>
<?php

/* session_start(); */

/* require 'inc/functions.php'; */

if ($_SESSION && $_SESSION['auth']->admin == 1) {
    ?>
 <a href="index.php?action=admin" class="btn btn-primary">Administration</a>
<?php
}

// On récupère les 5 derniers billets

while ($data = $posts->fetch()) {
    ?>
<div class="news">
    <h3>
        <?=htmlspecialchars($data->title);?>
        <em>le <?=$data->date_creation_fr;?></em>
    </h3>

    <p>
    <?=
    // On affiche le contenu du billet
    nl2br($data->content);
    ?>
    <br />
    <em><a href="index.php?action=post&amp;id=<?=$data->id?>">Commentaires</a></em>
    </p>
</div>
<?php
} // Fin de la boucle des billets
$posts->closeCursor();

?>
<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
