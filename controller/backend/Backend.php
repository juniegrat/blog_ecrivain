<?php
require './models/frontend.php';

class Backend
{

    public function addComment($postId, $author, $comment)
    {
        $affectedLines = postComment($postId, $author, $comment);
        session_start();
        if ($affectedLines === false) {
            $_SESSION['flash']['success'] = "Le commentaire n'a pas pu être posté";
        } else {
            $_SESSION['flash']['success'] = "Le commentaire à bien été posté";
        }
        header('Location: index.php?action=post&id=' . $postId);
    }
    public function rateComment($commentId, $postId)
    {
        $affectedLines = rateComment($commentId, $postId);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Le commentaire à bien été upvote";

        } else {

            $_SESSION['flash']['danger'] = "Il y eu une erreur veuillez réessayer plus tard";

        }

        header('location: index.php?action=post&id=' . $postId);
    }

    public function editPost($post)
    {

        $affectedLines = editPost($post);

        if (isset($errors) && in_array(Post::INVALID_TITLE, $errors)) {
            $_SESSION['flash']['danger'] = "Veuillez entrer un titre";
            throw new RuntimeException('emptyTitle');
        } elseif (isset($errors) && in_array(Post::INVALID_CONTENT, $errors)) {
            $_SESSION['flash']['danger'] = "Veuillez entrer du contenu";
            throw new RuntimeException('emptyContent');
        } else {
            $_SESSION['flash']['success'] = "L'article à bien été modifié";
        }
        header('location: index.php?action=edit&id=' . $post->getId());
    }

    public function deleteComment($commId, $postId)
    {

        $affectedLines = deleteComment($commId, $postId);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Le commentaire à bien été supprimé";

        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }

        header('location: index.php?action=edit&id=' . $postId);

        exit();
    }

    public function deletePost($postId)
    {

        $affectedLines = deletePost($postId);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "L'article à bien été supprimé";

        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }

        header('location: index.php?action=admin');

        exit();
    }

    public function addPost($postTitle, $postContent)
    {

        $affectedLines = addPost($postTitle, $postContent);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "L'article à bien été publié";

        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }

        header('location: index.php?action=admin');

        exit();
    }

    public function loginIn($login, $password, $remember)
    {

        $affectedLines = loginIn($login, $password, $remember);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";

            header('location: index.php?action=account');

            exit();

        } elseif ($affectedLines = "invalid") {

            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';

            header('location: index.php?action=loggin');

            exit();
        }
    }

    public function logout()
    {

        $affectedLines = logout();

        session_start();

        if ($affectedLines) {

            $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";

            header('location: index.php?action=loggin');
        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }
    }

    public function changePassword($password, $passwordConfirm)
    {

        $affectedLines = changePassword($password, $passwordConfirm);

        session_start();

        if ($affectedLines === false) {
            $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
        } else {
            $_SESSION['flash']['success'] = "Votre mot de passe à bien été mis à jour";
        }

        header('location: index.php?action=account');

        exit();
    }

    public function resetPassword($id, $token, $password, $passwordConfirm)
    {

        $affectedLines = resetPassword($id, $token, $password, $passwordConfirm);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Votre mot de passe à bien été modifié";

            $_SESSION['auth'] = $user;

            header('location: index.php?action=account');

            exit();

        } elseif ($affectedLines === "empty") {

            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            header('location: index.php?action=reset&id=' . $id . '&token=' . $token);

            exit();
        } elseif ($affectedLines === "invalidToken") {

            $_SESSION['flash']['danger'] = "Ce token n'est pas valide";

            header('location: index.php?action=loggin');

            exit();
        } else {
            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

            header('location: index.php?action=loggin');

            exit();
        }

    }

    public function forgot($mail)
    {

        $affectedLines = forgot($mail);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Les instructions du rappel de mot de passe vous ont été envoyés par email";

            header('location: index.php?action=forget');

        } elseif ($affectedLines === "unknownEmail") {

            $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse mail';

        } elseif ($affectedLines === "invalidEmail") {

            $_SESSION['flash']['danger'] = "L'adresse mail n'est pas valide";

        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }
    }

    public function registering($username, $mail, $password, $passwordConfirm)
    {

        $affectedLines = registering($username, $mail, $password, $passwordConfirm);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour valider votre compte";

            header('Location: index.php?action=loggin');

            exit();
        } else {

            header('Location: index.php?action=register');
        }
    }

    public function confirmUser($userId, $token)
    {

        $affectedLines = confirmUser($userId, $token);

        session_start();

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Votre compte à bien été validé";

            $_SESSION['auth'] = $user;

            header('location: index.php?action=account');

        } elseif ($affectedLines === "invalidToken") {

            $_SESSION['flash']['danger'] = "Ce token n'est plus valide";

            header('location: index.php?action=register');
        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

            header('location: index.php?action=register');

        }

    }

}
