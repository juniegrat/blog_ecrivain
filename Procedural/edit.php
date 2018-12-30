<?php

session_start();

require 'inc/functions.php';

admin_only();

require_once 'inc/db.php';

if (!empty($_POST)) {
    if (empty($_POST['title'])) {
        $_SESSION['flash']['danger'] = "Veuillez entrer un titre";
    } elseif (empty($_POST['content'])) {
        $_SESSION['flash']['danger'] = "Veuillez entrer du contenu";
    } else {
        $req = $pdo->prepare('UPDATE news SET title = ?, content = ? WHERE id = ?');

        $req->execute([$_POST['title'], $_POST['content'], $_GET['billet']]);

        $_SESSION['flash']['success'] = "L'article à bien été modifié";

    }
}

// On récupère l'article

$req = $pdo->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news WHERE id = ?');

$req->execute([$_GET['billet']]);

require 'inc/header.php';

while ($donnees = $req->fetch()) {
    ?>
    <p><a href="administration.php">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?php echo htmlspecialchars($donnees->title); ?>
            <em>le <?php echo $donnees->date_creation_fr; ?></em>
        </h3>

        <div>
            <?php echo nl2br($donnees->content); ?>
            <br/>
            </div>
    </div>
    <?php
} // Fin de la boucle des billets
$req->closeCursor();

// Récupération des commentaires
$req = $pdo->prepare('SELECT author, comment, id, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_news = ? ORDER BY rating_comment DESC');
$req->execute(array($_GET['billet']));

while ($donnees = $req->fetch()) {
    ?>
    <div class="comment">
            <p>
                    <a
                    href="delete.php?billet=<?=$donnees->id;?>&category=comments">&times;
                    </a>
        <strong>
            <?=htmlspecialchars($donnees->author);?>
        </strong>
        le <?=$donnees->date_comment_fr;?>
    </p>
    <?=nl2br(htmlspecialchars($donnees->comment));?>
    </div>
    <?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>

<form action="" method="POST">
    <div class="editor">
<input id="newsTitle" type="text" name="title" placeholder="Entrez un titre" > </div>
<textarea class="mytextarea-body" name="content" placeholder="Entrez du contenu" > </textarea>
    <br>
    <button class="btn btn-primary">Modifier</button>
</form>
</div>
<?php require 'inc/footer.php';?>
