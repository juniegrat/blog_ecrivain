<?php $title = 'Mon blog';?>

<?php ob_start();?>
<?php

/* session_start(); */

/* require 'inc/functions.php'; */

foreach ($posts as $post) {
    if ($post instanceof Post) {
        $postText = nl2br($post->getContent());
        ?>
<div class="news card w-75 mx-auto">
    <div class="card-body">
        <h3 class="card-title">
            <?=htmlspecialchars($post->getTitle());?>
        </h3>
        <em class="card-subtitle text-muted">le <?=$post->getDateCreation();?></em>
        <p class="post-card-text card-text">
        <?php echo $postText
        ?>
        </p>
        <br />
        <em><a class="btn btn-primary card-link" href="index.php?action=post&amp;id=<?=$post->getId()?>">Voir Plus</a></em>
    </div>
</div>
<?php
}
}
?>
<div class="btn-group col-6 mx-auto d-flex justify-content-around">
    <?php if ($page > 1): ?>
    <a href="?page=<?php echo $page - 1; ?>" class="btn next btn-primary mr-5">Précédent</a>
    <?php endif;
if ($page < $limit): ?>
    <a href="?page=<?php echo $page + 1; ?>" class="btn prev btn-primary ml-5">Suivant</a>
    <?php endif;?>
</div>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
