<?php if (!empty($_POST) && !empty($_POST['email'])) {

    // Connexion à la bdd
    require_once 'inc/db.php';

    require_once 'inc/functions.php';

    $req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');

    $req->execute([$_POST['email']]);

    $user = $req->fetch();

    if ($user) {

        session_start();

        $reset_token = str_random(60);

        $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);

        $_SESSION['flash']['success'] = "Les instructions du rappel de mot de passe vous ont été envoyés par email";

        mail($_POST['email'], 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien: \n\nhttp://localhost:8888/blog_ecrivain/reset.php?id={$user->id}&token=$reset_token");

        header('location: login.php');

        exit();

    } else {
        session_start();

        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse mail';

    }
}
require 'inc/header.php'?>


<h1>Mot de pass oublié</h1>

<form action="" method="POST">

    <div class="form-group">

        <label for="">Email</label>

        <input type="email" name="email" class="form-control" required/>

    </div>


    <button type="submit" class="btn btn-primary">Envoyer</button>

</form>


<?php require 'inc/footer.php';?>
