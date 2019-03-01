<?php
{
    require_once 'inc/functions.php';

    $_bdd;

    function setBdd()
    {
        $_bdd = new PDO('mysql:dbname=test', 'host=localhost', 'root', 'root', []);
        $_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $_bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $_bdd;
    }

    /* function getBdd()
    {
    if ($_bdd == null) {
    setBdd();
    }

    return $_bdd;
    } */

    function getPosts()
    {
        $_bdd = setBdd();

        $posts = $_bdd->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news ORDER BY date_creation DESC LIMIT 0, 5');

        return $posts;
    }

    function getPost($postId)
    {

        $_bdd = setBdd();

        $post = $_bdd->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news WHERE id = ?');

        $post->execute([$postId]);

        return $post;
    }

    function getComments($postId)
    {

        $_bdd = setBdd();

        $comments = $_bdd->prepare('SELECT id, author, comment, rating_comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_news = ? ORDER BY date_comment');

        $comments->execute([$postId]);

        return $comments;
    }

    function postComment($postId, $author, $comment)
    {
        $_bdd = setBdd();

        $comments = $_bdd->prepare('INSERT INTO comments SET id_news = :id_news , author = :author, comment = :comment, date_comment = NOW()');
        $affectedLines = $comments->execute(array(
            "id_news" => $postId,
            "author" => $author,
            "comment" => $comment,
        ));

        return $affectedLines;
    }

    function rateComment($commentId, $postId)
    {
        $_bdd = setBdd();

        $Upcomment = $_bdd->prepare('UPDATE comments SET rating_comment = rating_comment+1 WHERE id = ?');

        $affectedLines = $Upcomment->execute([$commentId]);

        return $affectedLines;

    }

    function deleteComment($commId, $postId)
    {
        $_bdd = setBdd();

        $req = $_bdd->prepare('DELETE FROM comments WHERE id = ?');

        $affectedLines = $req->execute([$commId]);

        return $affectedLines;
    }

    function deletePost($postId)
    {

        $_bdd = setBdd();

        $req = $_bdd->prepare('DELETE FROM news WHERE id = ?');

        $affectedLines = $req->execute(array($postId));

        return $affectedLines;
    }

    function addPost($postTitle, $postContent)
    {
        $_bdd = setBdd();

        $req = $_bdd->prepare('INSERT INTO news SET title = :title, content = :content, date_creation = NOW()');

        $affectedLines = $req->execute(array(
            "title" => $postTitle,
            "content" => $postContent,
        ));

        return $affectedLines;
    }
    function editPost($title, $content, $postId)
    {
        $_bdd = setBdd();

        $req = $_bdd->prepare('UPDATE news SET title = :title, content = :content WHERE id = :postId');

        $affectedLines = $req->execute([
            "title" => $title,
            "content" => $content,
            "postId" => $postId]);

        return $affectedLines;

    }

    function loginIn($login, $password, $remember)
    {

        $_bdd = setBdd();

        $req = $_bdd->prepare('SELECT * FROM users WHERE username = :username OR email = :username AND confirmed_at IS NOT NULL');

        $req->execute(['username' => $login]);

        $user = $req->fetch();

        if (password_verify($password, $user->password)) {

            $_SESSION['auth'] = $user;

            if ($remember) {

                $remember_token = str_random(250);

                $_bdd->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);

                setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'boi'), time() + 60 * 60 * 24 * 7);

            }

            $affectedLines = true;

        } else {

            $affectedLines = "invalidCredentials";

        }

        return $affectedLines;
    }
    function logout()
    {

        setcookie('remember', null, -1);

        unset($_SESSION['auth']);

        $affectedLines = true;

        return $affectedLines;

    }

    function forgot($mail)
    {

        $_bdd = setBdd();

        $req = $_bdd->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');

        $req->execute([$mail]);

        $user = $req->fetch();

        if ($user) {

            $reset_token = str_random(60);

            $affectedLines = $_bdd->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);

            mail($mail, 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien: \n\nhttp://localhost:8888/blog_ecrivain/index.php?action=reset&id={$user->id}&token=$reset_token");

        } else {

            $affectedLines = false;

        }

        return $affectedLines;
    }

    function registering($username, $mail, $password, $errors)
    {

        $_bdd = setBdd();

        $errors = [];

        $req = $_bdd->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$username]);
        $user = $req->fetch();
        if ($user) {
            $errors['username'] = 'Ce pseudo est déjà pris';
        }

        $req = $_bdd->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$mail]);
        $user = $req->fetch();
        if ($user) {
            $errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
        }

        if (empty($errors)) {

            $req = $_bdd->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $token = str_random(60);

            $req->execute([$username, $hashedPassword, $mail, $token]);

            $userId = $_bdd->lastInsertId();

            mail($mail, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien: \n\nhttp://localhost:8888/blog_ecrivain/index.php?action=confirm&id=$userId&token=$token");

            $affectedLines = true;

        } else {

            $_SESSION['errors'] = $errors;

            $affectedLines = false;
        }

        return $affectedLines;

    }

    function confirmUser($userId, $token)
    {
        $_bdd = setBdd();

        $req = $_bdd->prepare('SELECT * FROM users WHERE id = ?');

        $req->execute([$userId]);

        $user = $req->fetch();

        if ($user && $user->confirmation_token == $token) {

            $affectedLines = $req = $_bdd->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$userId]);

        } else {

            $affectedLines = "invalidToken";

        }

        return $affectedLines;
    }

    function resetPassword($id, $token, $password, $passwordConfirm)
    {

        $_bdd = setBdd();

        if (isset($id) && isset($token)) {

            $req = $_bdd->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');

            $req->execute([$id, $token]);

            $user = $req->fetch();

            if ($user) {

                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $affectedLines = $_bdd->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?')->execute([$hashedPassword, $id]);

            } else {
                $affectedLines = false;
            }

            return $affectedLines;

        }
    }

    function changePassword($password, $userId)
    {

        $_bdd = setBdd();

        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

        $affectedLines = $_bdd->prepare('UPDATE users SET password = :password WHERE user_id = :user_id ')->execute([
            "password" => $hashedpassword,
            "user_id" => $userId,
        ]);

        return $affectedLines;

    }

}
