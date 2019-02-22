<?php
require './models/frontend.php';

/* require './inc/functions.php'; */

function _listPosts()
{
    $posts = getPosts();

    require './views/frontend/listPostsView.php';
}

function _listPost()
{
    $post = $_GET['id'];
    $comments = $_GET['id'];
    require './views/frontend/postView.php';
}

function _addComment()
{
    $postId = $_GET['id'];
    $author = $_SESSION['auth']->username;
    $comment = $_POST['comment'];

    if (empty($comment)) {

        $_SESSION['flash']['danger'] = "Veuillez entrer un commentaire";

        _post();

    } elseif (empty($postId)) {

        $_SESSION['flash']['danger'] = "Identifiant commentaire invalide";

    } else {

        $affectedLines = postComment($postId, $author, $comment);

        if ($affectedLines === false) {

            $_SESSION['flash']['danger'] = "Le commentaire n'a pas pu être posté";

        } else {

            $_SESSION['flash']['success'] = "Le commentaire à bien été posté";

        }

        header('Location: index.php?action=post&id=' . $postId);

    }

}
function _rateComment()
{
    $commentId = $_GET['commentId'];
    $postId = $_GET['postId'];

    if (!empty($_POST)) {

        if (empty($commentId)) {

            $_SESSION['flash']['danger'] = "Veuillez entrer un identifiant valide";

        } elseif (empty($postId)) {

            $_SESSION['flash']['danger'] = "Veuillez entrer un titre";

        } else {
        }

        $affectedLines = rateComment($commentId, $postId);

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Le commentaire à bien été upvote";

        } else {

            $_SESSION['flash']['danger'] = "Il y eu une erreur veuillez réessayer plus tard";

        }

        header('location: index.php?action=post&id=' . $postId);
    }

}

function _admin()
{
    $posts = getPosts();

    require './views/frontend/adminView.php';
}

function _editPost()
{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $postId = $_GET['id'];

    if (!empty($_POST)) {

        if (empty($title) || empty($content) || empty($postId)) {

            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

        } elseif (empty($title)) {

            $_SESSION['flash']['danger'] = "Veuillez remplir le titre";

        } elseif (empty($content)) {

            $_SESSION['flash']['danger'] = "Veuillez remplir le contenu";

        } else {

            editPost($title, $content, $postId);

            $_SESSION['flash']['success'] = "L'article à bien été modifié";

            header('location: index.php?action=edit&id=' . $postId);

        }

    }

    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require './views/frontend/editView.php';
}

function _deleteComment()
{
    $commId = $_GET['id'];
    $postId = $_GET['postId'];

    if (empty($commId) || empty($postId)) {

        $_SESSION['flash']['danger'] = "Veuillez rentrer des identifiants valides";

    } else {

        $affectedLines = deleteComment($commId, $postId);

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Le commentaire à bien été supprimé";

        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }
    }
    header('location: index.php?action=edit&id=' . $postId);

    exit();
}

function _deletePost()
{

    $postId = $_GET['id'];

    if (empty($postId)) {

        $_SESSION['flash']['danger'] = "Veuillez rentrer un identifiant valide";

    } else {

        $affectedLines = deletePost($postId);

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "L'article à bien été supprimé";

        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }

        header('location: index.php?action=admin');

        exit();

    }
}

function _addPost()
{
    $postTitle = $_POST['title'];
    $postContent = $_POST['content'];

    if (!empty($_POST)) {

        $validation = true;

        if (empty($postTitle) || empty($postContent)) {

            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            $validation = false;
        }

        if ($validation) {

            addPost($postTitle, $postContent);

            header('location: index.php?action=admin');

            exit();

        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }
    }

    require './views/frontend/addPostView.php';
}

function _login()
{
    $login = $_POST['username'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    if (!empty($_POST)) {

        if (empty($login) || empty($password)) {

            $_SESSION['flash']['success'] = "Veuillez remplir tout les champs";

        } else {

            $affectedLines = loginIn($login, $password, $remember);

            if ($affectedLines === true) {

                $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";

                header('location: index.php?action=account');

                exit();

            } elseif ($affectedLines = "invalidCredentials") {

                $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';

                header('location: index.php?action=loggin');

                exit();
            }

        }
    }

    require './views/frontend/loginView.php';

}

function _logout()
{

    $affectedLines = logout();

    if ($affectedLines) {

        $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";

        header('location: index.php?action=loggin');

    } else {

        $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

    }
}
function _account()
{

    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];
    $userId = $_SESSION['auth']->id;

    if (!empty($_POST)) {

        if (empty($password) || empty($passwordConfirm)) {

            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

        }if ($password != $passwordConfirm) {

            $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";

        } else {

            $affectedLines = changePassword($password, $userId);

            if ($affectedLines === true) {

                $_SESSION['flash']['success'] = "Votre mot de passe à bien été mis à jour";

                header('location: index.php?action=account');

                exit();
            } else {

                $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

                header('location: index.php?action=account');

                exit();
            }

        }

    }

    require './views/frontend/accountView.php';

}

function _reset()
{

    $id = $_POST['id'];
    $token = $_GET['token'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];

    if (empty($password) && empty($passwordConfirm)) {

        $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

        header('location: index.php?action=loggin');

    } elseif ($password != $passwordConfirm) {

        $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";

        header('location: index.php?action=loggin');

    } else {

        $affectedLines = resetPassword($id, $token, $password, $passwordConfirm);

        if ($affectedLines === true) {

            $_SESSION['flash']['success'] = "Votre mot de passe à bien été modifié";

            header('location: index.php?action=account');

            exit();

        } elseif ($affectedLines === false) {

            $_SESSION['flash']['danger'] = "Ce token n'est pas valide";

            header('location: index.php?action=loggin');

            exit();

        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

            header('location: index.php?action=loggin');

            exit();
        }

    }
}
function _forget()
{
    $mail = $_POST['mail'];

    if (!empty($_POST)) {

        if (!empty($mail)) {

            $affectedLines = forgot($mail);

            if ($affectedLines == true) {

                $_SESSION['flash']['success'] = "Les instructions du rappel de mot de passe vous ont été envoyés par email";

                header('location: index.php?action=forget');

            } elseif ($affectedLines == false) {

                $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse mail';

            } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                $_SESSION['flash']['danger'] = "Veuillez saisir une adresse email valide";

            } else {

                $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

            }

        }

        $_SESSION['flash']['danger'] = "Veuillez saisir une adresse email";

    }

    require './views/frontend/forgetView.php';

}

function _register()
{

    $errors = [];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];

    if (!empty($_POST)) {

        if (empty($username) || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {

            $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre email n'est pas valide";
        }

        if (empty($password) || $password != $passwordConfirm) {
            $errors['password'] = "Vous devez rentrer un mot de passe valide";
        }

        if (empty($username) || empty($email) || empty($password) || empty($passwordConfirm)) {

            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

        } else {

            $affectedLines = registering($username, $email, $password, $errors);

            if ($affectedLines === true) {

                $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour valider votre compte";

                header('Location: index.php?action=loggin');

                exit();

            } else {

                header('Location: index.php?action=register');

            }

        }

    }
    require './views/frontend/registerView.php';
}

function _confirmUser()
{

    $userId = $_SESSION['auth']->id;

    $token = $_GET['token'];

    if (!empty($_POST)) {

        if (empty($token)) {
            $_SESSION['flash']['danger'] = "Veuillez entrer un identifiant valide";

        } else {

            $affectedLines = confirmUser($userId, $token);

            if ($affectedLines === true) {

                $_SESSION['flash']['success'] = "Votre compte à bien été validé";

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
}
function _error()
{
    require './views/frontend/errorView.php';
}
