<?php

session_start();

require 'inc/functions.php';

logged_only();

require_once 'inc/db.php';

require 'inc/header.php';

if ($_SESSION['auth']->admin == 1) {
    ?>
 <a href="administration.php" class="btn btn-primary">Administration</a>
<?php
}

// On récupère les 5 derniers billets
$req = $pdo->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $req->fetch()) {
    ?>
<div class="news">
    <h3>
        <?php echo htmlspecialchars($donnees->title); ?>
        <em>le <?php echo $donnees->date_creation_fr; ?></em>
    </h3>

    <p>
    <?php
// On affiche le contenu du billet
    echo nl2br($donnees->content);
    ?>
    <br />
    <em><a href="comments.php?billet=<?php echo $donnees->id; ?>">Commentaires</a></em>
    </p>
</div>
<?php
} // Fin de la boucle des billets
$req->closeCursor();

require 'inc/footer.php';?>

