<?php

session_start();

/* require './inc/functions.php'; */

/* logged_only(); */

?>

<?php $title = 'Mon blog';?>

<?php ob_start();?>

<?php

// On récupère l'article

while ($data = $post->fetch()) {
    ?>
    <p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?=$data->title;?>
            <em>le <?=$data->date_creation_fr;?></em>
        </h3>

        <p>
            <?=
    // On affiche le contenu du billet
    nl2br($data->content);
    ?>
        <br/>
        </p>
    </div>
    <?php

} // Fin de la boucle des billets
$post->closeCursor();

// Récupération des commentaires

while ($data = $comments->fetch()) {
    ?>
    <div class="comment">
        <div class="comment-heading">

            <form action="index.php?action=rateComment&commentId=<?=$data->id;?>&postId=<?=$_GET['id'];?>" method="POST">
                    <input type="submit" id=commentButton name="commentButton"  value=&radic;  >
                    <input type="hidden" id=commentId name="commentId"  value=<?=$data->id;?>  >
            </form>

                <strong>
                    <?=htmlspecialchars($data->author);?>
                </strong>
                le <?=$data->date_comment_fr;?>

               <strong>+<?=$data->rating_comment?> Votes</strong>
    </div>
        <?=nl2br(htmlspecialchars($data->comment));?>
    </div>
    <?php
} // Fin de la boucle des commentaires
$comments->closeCursor();
?>
<?php
if ($_SESSION && $_SESSION['auth']): ?>
<h4>Laissez un commentaire</h4>
<form action="index.php?action=addComment&amp;id=<?=$_GET['id']?>" method="POST">
    <div class="form-group">
        <textarea class="form-control" name="comment" placeholder="Contenu du commentaire"></textarea>
    </div>
    <input type="hidden" name="author" value="<?=$_SESSION['auth']->username?>">
    <button class="btn btn-primary">Envoyer</button>
</form>

<?php endif;?>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
