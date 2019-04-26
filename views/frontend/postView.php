<?php

/* session_start(); */

/* require './inc/functions.php'; */

/* logged_only(); */

?>

<?php $title = 'Mon blog';?>

<?php ob_start();?>

<?php

// On récupère l'article

if ($post instanceof Post) {
    ?>
    <p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>

    <div class="news w-50 mx-auto">
        <h3>
            <?=$post->getTitle();?>
            <em>le <?=$post->getDateCreation();?></em>
        </h3>

        <div class="content-display">
            <?=
    nl2br($post->getContent());
    ?>
        <br/>
        </div>
    </div>
    <?php
}

// Récupération des commentaires

foreach ($comments as $comment) {
    if ($comment instanceof Comment) {
        ?>

    <div class="comment mx-auto my-5 card p-4 h-100">

        <div class="comment-heading">

            <form class="form"action="index.php?action=rateComment&commentId=<?=$comment->getId();?>&postId=<?=$_GET['id'];?>" method="POST">
                    <input class="form-control btn-sm p-0" type="submit" id=commentButton name="commentButton"  value="signaler">
                    <input class="form-control" type="hidden" id=commentId name="commentId"  value=<?=$comment->getId();?>  >
            </form>

                <strong>
                    <?=htmlspecialchars($comment->getAuthor());?>
                </strong>
                le <?=$comment->getDateComment();?>

               <strong><?=$comment->getRatingComment()?> 👎</strong>
    </div>
        <?=nl2br(htmlspecialchars($comment->getComment()));?>
    </div>
    <?php
}
}
?>
<?php
if (isset($_SESSION['auth']) && $_SESSION['auth']): ?>
<h4>Laissez un commentaire</h4>
<form class="form mx-auto" action="index.php?action=addComment&amp;id=<?=$_GET['id']?>" method="POST">
    <div class="form-group">

        <textarea class="form-control w-50" name="comment" placeholder="Contenu du commentaire" ></textarea>

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>
    </div>
    <button class="btn btn-primary">Envoyer</button>
</form>

<?php endif;?>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
