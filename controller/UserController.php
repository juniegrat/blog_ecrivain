<?php
require './models/frontend.php';

class UserController
{

    public function __construct()
    {

    }

    public function _login()
    {
        $login = $_POST['username'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];

        if (!empty($_POST)) {

            if (empty($login) || empty($password)) {

                $_SESSION['flash']['success'] = "Veuillez remplir tout les champs";

            } else {

                $affectedLines = login($login, $password, $remember);

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
        }

        require './views/frontend/loginView.php';

    }

    public function _logout()
    {

        $affectedLines = logout();

        if ($affectedLines) {

            $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";

            header('location: index.php?action=loggin');
        } else {

            $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

        }
    }
    public function _account()
    {

        $password = $_POST['password'];
        $passwordConfirm = $_POST['password_confirm'];

        if (!empty($_POST)) {

            if (empty($password) || empty($passwordConfirm)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            } else {

                $affectedLines = changePassword($password, $passwordConfirm);

                if ($affectedLines === false) {

                    $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";

                } else {

                    $_SESSION['flash']['success'] = "Votre mot de passe à bien été mis à jour";

                    header('location: index.php?action=account');

                    exit();
                }

            }

        }

        require './views/frontend/accountView.php';

    }

    public function _reset()
    {

        $id = $_POST['id'];
        $token = $_GET['token'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password_confirm'];

        if (empty($id) || empty($token) || empty($password) || empty($passwordConfirm)) {

            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            header('location: index.php?action=reset&id=' . $id . '&token=' . $token);

            exit();

        } else {

            $affectedLines = resetPassword($id, $token, $password, $passwordConfirm);

            if ($affectedLines === true) {

                $_SESSION['flash']['success'] = "Votre mot de passe à bien été modifié";

                header('location: index.php?action=account');

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
    }
    public function _forget()
    {
        $mail = $_POST['mail'];

        if (empty($_POST)) {

            if (!empty($mail)) {
            }
            $affectedLines = forget($mail);

            if ($affectedLines == true) {

                $_SESSION['flash']['success'] = "Les instructions du rappel de mot de passe vous ont été envoyés par email";

                header('location: index.php?action=forget');

            } elseif ($affectedLines == "unknownEmail") {

                $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse mail';

            } elseif ($affectedLines == "invalidEmail") {

                $_SESSION['flash']['danger'] = "L'adresse mail n'est pas valide";

            } else {

                $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

            }

            $_SESSION['flash']['danger'] = "Veuillez saisir une adresse email";

        }

        require './views/frontend/forgetView.php';

    }

    public function _register()
    {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password_confirm'];

        if (!empty($_POST)) {

            if (empty($username) || empty($email) || empty($password) || empty($passwordConfirm)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            } else {

                $affectedLines = register($username, $email, $password, $passwordConfirm);

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

    public function _confirmUser()
    {

        $userId = $_SESSION['auth']->id;

        $token = $_GET['token'];

        if (!empty($_POST)) {

            if (empty($token)) {

                $_SESSION['flash']['danger'] = "Veuillez entrer un identifiant valide";

            } else {

                $affectedLines = confirm($userId, $token);

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
}
