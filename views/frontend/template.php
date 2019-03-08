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

    <link rel="stylesheet" href="./public/css/app.css">

    <link rel="stylesheet" href="./public/css/main.css">
   <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
   <script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=t5niqycm0fdijcdvb49k04fbkn79lw4x2anllbhx83d4vz2n'></script>
  <script src="./public/js/tinymce.js" type="text/javascript"></script>

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
    <a class="navbar-brand" href="index.php?action=listPosts">Vent d'Alaska</a>
    <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <?php if (isset($_SESSION['auth'])): ?>
            <li><a href="index.php?action=logout">Se déconnecter</a></li>

            <?php else: ?>
            <li><a href="index.php?action=register">S'inscrire</a></li>
            <li><a href="index.php?action=login">Se connecter</a></li>
            <?php endif;?>
        </ul>
    </div>
</nav>

<div class="container">

    <?php if (isset($_SESSION['flash'])): ?>

        <?php foreach ($_SESSION['flash'] as $type => $message): ?>

            <div class="alert alert-<?=$type;?>">

                <?=$message;?>

            </div>

        <?php endforeach;?>

    <?php unset($_SESSION['flash']);?>

    <?php endif;?>




        <?=$content?>

</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        forms = document.getElementsByClassName("form");
        window.addEventListener('load', function () {
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>