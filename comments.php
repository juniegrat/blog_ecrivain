<?php

session_start();

require 'inc/functions.php';

logged_only();

require 'inc/header.php' ?>

<?php

require_once 'inc/db.php';

if (!empty($_POST)) {

    if (empty($_POST['comment'])) {
        $_SESSION['flash']['danger'] = "Veuillez entrer un commentaire";
    } else {
        $req = $pdo->prepare('INSERT INTO comments SET id_news = ?, author = ?, comment = ?, date_comment = NOW()');

        $req->execute([$_GET['billet'], $_SESSION['auth']->username, $_POST['comment']]);

        $_SESSION['flash']['success'] = "Le commentaire à bien été posté";


    }
}
// On récupère l'article

$req = $pdo->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news WHERE id = ?');

$req->execute([$_GET['billet']]);

while ($donnees = $req->fetch()) {
    ?>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?php echo htmlspecialchars($donnees->title); ?>
            <em>le <?php echo $donnees->date_creation_fr; ?></em>
        </h3>

        <p>
            <?php
            // On affiche le contenu du billet
            echo nl2br(htmlspecialchars($donnees->content));
            ?>
            <br/>
        </p>
    </div>
    <?php

} // Fin de la boucle des billets
$req->closeCursor();

// Récupération des commentaires
$req = $pdo->prepare('SELECT author, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_news = ? ORDER BY date_comment');
$req->execute(array($_GET['billet']));

while ($donnees = $req->fetch()) {
    ?>
    <p><strong><?php echo htmlspecialchars($donnees->author); ?></strong>
        le <?php echo $donnees->date_comment_fr; ?></p>
    <p><?php echo nl2br(htmlspecialchars($donnees->comment)); ?></p>
    <?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>

<h3>Nouveau commentaire</h3>
<form action="" method="POST">
    <div class="form-group">
        <input class="form-control" type="text" name="comment" placeholder="Contenu du commentaire">
    </div>

    <button class="btn btn-primary">Envoyer</button>
</form>

<?php require 'inc/footer.php'; ?>
