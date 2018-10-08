<?php

session_start();

require 'inc/functions.php';

admin_only();

require_once 'inc/db.php';

if (!empty($_POST)) {

    if (empty($_POST['title'])) {
        $_SESSION['flash']['danger'] = "Veuillez indiquer un titre";
    } elseif (empty($_POST['content'])) {
        $_SESSION['flash']['danger'] = "Veuillez entrer le contenu de l'article";
    } else {
        $req = $pdo->prepare('INSERT INTO news SET title = ?, content = ?, date_creation = NOW()');

        $req->execute([$_POST['title'], $_POST['content']]);

        $_SESSION['flash']['success'] = "L'article à bien été publié";
    }
}

require 'inc/header.php';

?>
    <p><a href="administration.php">Retour à la liste des billets</a></p>

<h2>Ajouter un nouvel article</h2>

<div class="editor">
<form action="" method="POST">
        <input id="newsTitle" type="text" name="title" placeholder="Entrez un titre" > </div>
        <textarea class="mytextarea-body" name="content" placeholder="Entrez du contenu" > </textarea>
    <br>
    <button class="btn btn-primary">Publier</button>
</form>
</div>
<?php require 'inc/footer.php';?>
