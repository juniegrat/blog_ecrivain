<?php

/* session_start(); */

/* require 'inc/functions.php'; */

?>

<?php $title = 'Mon blog';?>

<?php ob_start();?>

<a href="index.php?action=addPost" class="btn btn-primary">Ajouter un article</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Date de création</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
// On récupère les 5 derniers billets
foreach ($posts as $post) {
    if ($post instanceof Post) {
        $pid = $post->getId();
        ?>
        <tr>
            <th scope="row"><?=$pid?></th>
            <td><?=$post->getTitle();?></td>
            <td><?=$post->getDateCreation();?></td>
            <td>
                <em><a class="btn btn-primary"
                        href="index.php?action=editPost&id=<?=$pid?>">Editer</a></em>
                <em><a class="btn btn-danger text-white" data-toggle="modal" data-target="#deleteModal">Supprimer</a></em>
            </td>
        </tr>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span class="text-capitalize">êtes</span> vous sûr de vouloir supprimer l'article ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                        <a class="btn btn-danger text-white"
                        href="index.php?action=delete&id=<?=$pid?>&category=news">
                                Oui</a>
                    </div>
                </div>
            </div>
        </div>


        <?php
}
}
?>
    </tbody>
</table>


<?php $content = ob_get_clean();?>

<?php require 'template.php';?>