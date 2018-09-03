<?php

session_start();

require 'inc/functions.php';

logged_only();

require 'inc/header.php' ?>

<?php

require_once  'inc/db.php';

if(!empty($_POST)){

    if(empty($_POST['title'])){
        $_SESSION['flash']['danger'] = "Veuillez indiquer un titre";
    }elseif(empty($_POST['content'])){

        $_SESSION['flash']['danger'] = "Veuillez entrer le contenu de l'article";
    }else{
        $req = $pdo->prepare('INSERT INTO news SET title = ?, content = ?, date_creation = NOW()');

        $req->execute([$_POST['title'],$_POST['content']]);

        $_SESSION['flash']['success'] = "Le billet à bien été posté";
    }
}

// On récupère les 5 derniers billets
$req = $pdo->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $req->fetch())
{
?>
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
    <br />
    <em><a href="comments.php?billet=<?php echo $donnees->id; ?>">Commentaires</a></em>
    </p>
</div>
<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
<form action="" method="POST">
    <div class="form-group">
        <input class="form-control" type="text" name="title" placeholder="Titre du billet">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="content" placeholder="Entrez votre texte">
    </div>

    <button class="btn btn-primary">Envoyer</button>
</form>

<?php require 'inc/footer.php'; ?>

