<?php

/* session_start(); */

/* require 'inc/functions.php'; */

/* admin_only(); */
?>

<?php $title = 'Mon blog';
?>

<?php ob_start();

if ($post instanceof Post) {
    ?>
    <p><a href="index.php?action=admin">Retour à la liste des billets</a></p>

    <div class="news w-50 mx-auto">
        <h3>
            <?=htmlspecialchars($post->getTitle());?>
            <em>le <?=$post->getDateCreation();?></em>
        </h3>

        <div class="content-display">
            <?=$post->getContent();?>
            <br/>
        </div>
    </div>
    <form class="form"action="index.php?action=editPost&id=<?=$_GET['id'];?>" method="POST">

        <div class="editor">

            <input id="newsTitle" type="text" name="title" value="<?=$post->getTitle()?>" >


            <div class="invalid-feedback">
                Veuillez ajouter un nom valide.
            </div>
        </div>


        <textarea class="mytextarea-body" name="content" ><?=$post->getContent();?></textarea>


        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>

        <br>
        <button class="btn btn-primary">Modifier</button>
    </form>
    <?php
}
// Récupération des commentaires

foreach ($comments as $comment) {
    if ($comment instanceof Comment) {
        ?>
    <div class="comment mx-auto">
            <p>
                    <a data-toggle="modal" data-target="#deleteModal">&times;</a>
        <strong>
            <?=htmlspecialchars($comment->getAuthor());?>
        </strong>
        le <?=$comment->getDateComment();?> <strong>+<?=$comment->getRatingComment()?> Signalement(s)</strong>
    </p>
    <?=nl2br(htmlspecialchars($comment->getComment()));?>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span class="text-capitalize">êtes</span> vous sûr de vouloir supprimer le commentaire ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>

            <a class="btn btn-danger text-white" href="index.php?action=delete&id=<?=$comment->getId();?>&postId=<?=$_GET['id']?>&category=comments" > Oui</a>

          </div>
        </div>
      </div>
    </div>
    <?php
}
}
?>

</div>
<?php $content = ob_get_clean();?>

<?php require 'template.php';?>

