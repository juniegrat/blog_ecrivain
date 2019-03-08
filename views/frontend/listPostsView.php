<?php $title = 'Mon blog';?>

<?php ob_start();?>
<?php

/* session_start(); */

/* require 'inc/functions.php'; */

if (isset($_SESSION['auth']) && $_SESSION['auth']->admin == 1) {
    ?>
 <a href="index.php?action=admin" class="btn btn-primary">Administration</a>
<?php
}

// On récupère les 5 derniers billets

foreach ($posts as $post) {
    if ($post instanceof Post) {
        ?>
<div class="news">
    <h3>
        <?=htmlspecialchars($post->getTitle());?>
        <em>le <?=$post->getDateCreation();?></em>
    </h3>

    <p>
    <?=
        // On affiche le contenu du billet
        nl2br($post->getContent());
        ?>
    <br />
    <em><a href="index.php?action=post&amp;id=<?=$post->getId()?>">Commentaires</a></em>
    </p>
</div>
<?php
}
}

?>
<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
