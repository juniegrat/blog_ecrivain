<?php

/* session_start(); */

/* require 'inc/functions.php'; */

admin_only();
?>

<?php $title = 'Mon blog';
?>

<?php ob_start();?>

    <p><a href="index.php?action=admin">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?=htmlspecialchars($post->title);?>
            <em>le <?=$post->date_creation_fr;?></em>
        </h3>

        <div>
            <?=nl2br($post->content);?>
            <br/>
            </div>
    </div>
    <?php

// Récupération des commentaires

foreach ($comments as $comment) {
    ?>
    <div class="comment">
            <p>
                    <a
                    href="index.php?action=delete&id=<?=$comment->id;?>&postId=<?=$_GET['id']?>&category=comments">&times;
                    </a>
        <strong>
            <?=htmlspecialchars($comment->author);?>
        </strong>
        le <?=$comment->date_comment_fr;?>
    </p>
    <?=nl2br(htmlspecialchars($comment->comment));?>
    </div>
    <?php
} // Fin de la boucle des commentaires
$comments->closeCursor();
?>

<form action="index.php?action=editPost&id=<?=$_GET['id'];?>" method="POST">

    <div class="editor">
        <input id="newsTitle" type="text" name="title" placeholder="Entrez un titre" >

        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>
    </div>

    <textarea class="mytextarea-body" name="content" placeholder="Entrez du contenu" > </textarea>

    <div class="invalid-feedback">
        Veuillez ajouter un nom valide.
    </div>

    <br>
    <button class="btn btn-primary">Modifier</button>
</form>
</div>
<?php $content = ob_get_clean();?>

<?php require 'template.php';?>

