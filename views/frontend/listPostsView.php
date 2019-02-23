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

foreach ($posts as $post) {
    ?>
<div class="news">
    <h3>
        <?=htmlspecialchars($posts->title);?>
        <em>le <?=$posts->date_creation_fr;?></em>
    </h3>

    <p>
    <?=
    // On affiche le contenu du billet
    nl2br($posts->content);
    ?>
    <br />
    <em><a href="index.php?action=post&amp;id=<?=$posts->id?>">Commentaires</a></em>
    </p>
</div>
<?php
}

?>
<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
