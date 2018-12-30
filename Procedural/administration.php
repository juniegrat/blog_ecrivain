<?php

session_start();

require 'inc/functions.php';

admin_only();

require 'inc/header.php';

require_once 'inc/db.php';

?>
    <a href="add.php" class="btn btn-primary">Ajouter un article</a>

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
$req = $pdo->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news ORDER BY date_creation DESC');

while ($donnees = $req->fetch()) {
        ?>
            <tr>
                <th scope="row"><?=$donnees->id;?></th>
                <td><?=$donnees->title;?></td>
                <td><?=$donnees->date_creation_fr;?></td>
                <td>
                    <em><a class="btn btn-primary" href="edit.php?billet=<?php echo $donnees->id; ?>">Editer</a></em>
                    <em><a class="btn btn-danger" href="delete.php?billet=<?php echo $donnees->id; ?>&category=news">Supprimer</a></em>
                </td>
            </tr>


        <?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
        </tbody>
    </table>

<?php require 'inc/footer.php';?>