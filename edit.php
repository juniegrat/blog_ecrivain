<?php

session_start();

require 'inc/functions.php';

logged_only();


if (!empty($_POST)) {
    print_r($_POST);

    if (empty($_POST['comment'])) {
        $_SESSION['flash']['danger'] = "Veuillez entrer un commentaire";
    } else {
        $req = $pdo->prepare('INSERT INTO comments SET id_news = ?, author = ?, comment = ?, date_comment = NOW()');

        $req->execute([$_GET['billet'], $_SESSION['auth']->username, $_POST['comment']]);

        $_SESSION['flash']['success'] = "Le commentaire à bien été posté";

    }
}

require_once 'inc/db.php';
// On récupère l'article

$req = $pdo->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news WHERE id = ?');

$req->execute([$_GET['billet']]);

require 'inc/header.php' ;

while ($donnees = $req->fetch()) {
    ?>
    <p><a href="administration.php">Retour à la liste des billets</a></p>

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

<h3>Modifier le commentaire</h3>
<input id="button_bold" type="button" value="G" style="font-weight: bold;" onclick="commande('bold');" />
<input  id="button_italic" type="button" value="I" style="font-style: italic;" onclick="commande('italic');" />
<input  id="button_underline" type="button" value="S" style="text-decoration: underline;" onclick="commande('underline');" />
<input  id="button_createLink" type="button" value="Lien" onclick="commande('createLink');" >
<input  id="button_insertImage" type="button" value="Image" onclick="commande('insertImage');" >
<select onchange="commande('heading', this.value); this.selectedIndex = 0;">
    <option value="">Titre</option>
    <option value="h1">Titre 1</option>
    <option value="h2">Titre 2</option>
    <option value="h3">Titre 3</option>
    <option value="h4">Titre 4</option>
    <option value="h5">Titre 5</option>
    <option value="h6">Titre 6</option>
</select>
<form action="" method="POST">
<div id="editeur" contenteditable = true name="content">
</div>
    <button class="btn btn-primary">Modifier</button>
</form>
<?php require 'inc/footer.php'; ?>
