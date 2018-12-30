<?php

session_start();

/* require 'inc/functions.php'; */

admin_only();
?>

<?php $title = 'Mon blog';
?>

<?php ob_start();?>

<?php

// On récupère l'article

while ($data = $post->fetch()) {
    ?>
    <p><a href="index.php?action=admin">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?=htmlspecialchars($data->title);?>
            <em>le <?=$data->date_creation_fr;?></em>
        </h3>

        <div>
            <?=nl2br($data->content);?>
            <br/>
            </div>
    </div>
    <?php
} // Fin de la boucle des billets
$post->closeCursor();

// Récupération des commentaires

while ($data = $comments->fetch()) {
    ?>
    <div class="comment">
            <p>
                    <a
                    href="index.php?action=delete&id=<?=$data->id;?>&postId=<?=$_GET['id']?>&category=comments">&times;
                    </a>
        <strong>
            <?=htmlspecialchars($data->author);?>
        </strong>
        le <?=$data->date_comment_fr;?>
    </p>
    <?=nl2br(htmlspecialchars($data->comment));?>
    </div>
    <?php
} // Fin de la boucle des commentaires
$comments->closeCursor();
?>

<form action="index.php?action=editPost&id=<?=$_GET['id'];?>" method="POST">
    <div class="editor">
<input id="newsTitle" type="text" name="title" placeholder="Entrez un titre" > </div>
<textarea class="mytextarea-body" name="content" placeholder="Entrez du contenu" > </textarea>
    <br>
    <button class="btn btn-primary">Modifier</button>
</form>
</div>
<?php $content = ob_get_clean();?>

<?php require 'template.php';?>

