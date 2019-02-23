<?php

/* session_start(); */

/* require 'inc/functions.php'; */

admin_only();
?>

<?php $title = 'Mon blog';?>

<?php ob_start();?>

    <a href="index.php?action=add" class="btn btn-primary">Ajouter un article</a>

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
    ?>
            <tr>
                <th scope="row"><?=$data->id;?></th>
                <td><?=$data->title;?></td>
                <td><?=$data->date_creation_fr;?></td>
                <td>
                    <em><a class="btn btn-primary" href="index.php?action=edit&id=<?php echo $data->id; ?>">Editer</a></em>
                    <em><a class="btn btn-danger" href="index.php?action=delete&id=<?php echo $data->id; ?>&category=news">Supprimer</a></em>
                </td>
            </tr>


        <?php
}
?>
        </tbody>
    </table>


<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
