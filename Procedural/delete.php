<?php

session_start();

require 'inc/functions.php';

admin_only();

require_once 'inc/db.php';

if ($_GET['category'] === 'news') {
    $req = $pdo->prepare('DELETE FROM news WHERE id = ?');

    $req->execute([$_GET['billet']]);

    $_SESSION['flash']['success'] = "L'article à bien été supprimé";
} else {
    $req = $pdo->prepare('DELETE FROM comments WHERE id = ?');

    $req->execute([$_GET['billet']]);

    $_SESSION['flash']['success'] = "Le commentaire à bien été supprimé";
}
header('location: administration.php');
exit();
