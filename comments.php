<?php

session_start();

require 'inc/functions.php';

logged_only();

require_once 'inc/db.php';

if (!empty($_POST)) {

    if (empty($_POST['comment']) && empty($_POST['commentButton'])) {

        $_SESSION['flash']['danger'] = "Veuillez entrer un commentaire";

    } elseif (!empty($_POST['commentButton'])) {

        $req = $pdo->prepare('SELECT rating_comment FROM comments  WHERE id = ?');

        $req->execute([$_POST['commentId']]);

        $upvote = $req->fetch();

        $req = $pdo->prepare('UPDATE comments SET rating_comment = ?  WHERE id = ?');

        $req->execute([$upvote->rating_comment + 1, $_POST['commentId']]);

        $_SESSION['flash']['success'] = "Le commentaire à bien été upvote";

    } else {
        $req = $pdo->prepare('INSERT INTO comments SET id_news = ?, author = ?, comment = ?, date_comment = NOW()');

        $req->execute([$_GET['billet'], $_SESSION['auth']->username, $_POST['comment']]);

        $_SESSION['flash']['success'] = "Le commentaire à bien été posté";

    }
}
require 'inc/header.php';
// On récupère l'article

$req = $pdo->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news WHERE id = ?');

$req->execute([$_GET['billet']]);

while ($donnees = $req->fetch()) {
    ?>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?=$donnees->title;?>
            <em>le <?=$donnees->date_creation_fr;?></em>
        </h3>

        <p>
            <?=
    // On affiche le contenu du billet
    nl2br($donnees->content);
    ?>
        <br/>
        </p>
    </div>
    <?php

} // Fin de la boucle des billets
$req->closeCursor();

// Récupération des commentaires
$req = $pdo->prepare('SELECT id, author, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_news = ? ORDER BY date_comment');
$req->execute(array($_GET['billet']));

while ($donnees = $req->fetch()) {
    ?>
    <div class="comment">
        <div class="comment-heading">

            <form action="" method="POST">
                    <input type="submit" id=commentButton name="commentButton"  value=&radic;  >
                    <input type="hidden" id=commentId name="commentId"  value=<?php echo $donnees->id; ?>  >
            </form>

                <strong>
                    <?php echo htmlspecialchars($donnees->author); ?>
                </strong>
                le <?php echo $donnees->date_comment_fr; ?>

    </div>
        <?php echo nl2br(htmlspecialchars($donnees->comment)); ?>
    </div>
    <?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>

<h4>Laissez un commentaire</h4>
<form action="" method="POST">
    <div class="form-group">
        <textarea class="form-control" name="comment" placeholder="Contenu du commentaire"></textarea>
    </div>
    <button class="btn btn-primary">Envoyer</button>
</form>

<?php require 'inc/footer.php';?>
