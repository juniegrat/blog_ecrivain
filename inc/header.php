<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Vent d'alska</title>

    <link rel="stylesheet" href="css/app.css">

    <link rel="stylesheet" href="css/main.css">

    <script src="editor.js"></script>

</head>

<body>


<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </div>
    <a class="navbar-brand" href="index.php">Vent d'Alaska</a>
    <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <?php if(isset($_SESSION['auth'])): ?>
            <li><a href="logout.php">Se déconnecter</a></li>

            <?php else: ?>
            <li><a href="register.php">S'inscrire</a></li>
            <li><a href="login.php">Se connecter</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container">

    <?php if (isset($_SESSION['flash'])): ?>

        <?php foreach ($_SESSION['flash'] as $type => $message): ?>

            <div class="alert alert-<?= $type; ?>">

                <?= $message; ?>

            </div>

        <?php endforeach; ?>

    <?php unset($_SESSION['flash']); ?>

    <?php endif; ?>


