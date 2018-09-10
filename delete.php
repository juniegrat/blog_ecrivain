<?php

session_start();

require 'inc/functions.php';

admin_only();

require_once 'inc/db.php';

$req = $pdo->prepare('DELETE FROM news WHERE id = ?');

$req->execute([$_GET['billet']]);

$_SESSION['flash']['success'] = "L'article à bien été supprimé";

header('location: administration.php');