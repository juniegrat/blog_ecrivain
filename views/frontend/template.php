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

<!--     <link rel="stylesheet" href="./public/css/app.css">
 -->
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=t5niqycm0fdijcdvb49k04fbkn79lw4x2anllbhx83d4vz2n'></script>
    <script src="./public/js/tinymce.js" type="text/javascript"></script>

</head>

<body>


<nav class="navbar navbar-expand-lg navbar-light bg-primary navbar-dark">
    <a class="navbar-brand" href="index.php?action=listPosts">Vent d'Alaska</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <?php if (isset($_SESSION['auth'])): ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php?action=logout">Se déconnecter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?action=account">Compte</a>
      </li>
      <?php else: ?>
      <li class="nav-item">
      <a class="nav-link" href="index.php?action=register">S'inscrire</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="index.php?action=login">Se connecter</a>
      </li>
      <?php endif;?>
      <?php if (isset($_SESSION['auth']) && $_SESSION['auth']->admin == 1):
?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=admin">Administration</a>
    </li>
<?php
endif;
?>
    </ul>
  </div>
</nav>

<div class="container pt-5">

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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields

    let forms = document.getElementsByClassName("form");
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

    var postCardTexts = document.getElementsByClassName('post-card-text');
    for(var i=0; i < postCardTexts.length; i++){
        postCardTexts[i].append(postCardTexts[i].nextSibling.innerHTML);
        postCardTexts[i].nextSibling.remove();

        if(postCardTexts[i].innerHTML.length >= 50){
            postCardTexts[i].innerHTML.slice(50);
            postCardTexts[i].innerHTML += "...";
        }
    }
</script>
</body>
</html>