<?php
require './models/UserManager.php';
class UserController
{

    protected $userManager;
    protected $general;

    public function __construct()
    {

        $this->userManager = new UserManager;
        $this->general = new General;
    }

    public function login()
    {

        if (!empty($_POST)) {

            $login = $_POST['username'];
            $password = $_POST['password'];
            isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = false;

            if (empty($login) || empty($password)) {

                $_SESSION['flash']['success'] = "Veuillez remplir tout les champs";
            } else {

                try {
                    $this->userManager->login($login, $password, $remember);
                } catch (Exception $e) {

                    $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';

                    header('location: index.php?action=login');

                    exit();
                }

                $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";

                header('location: index.php?action=listPosts');

                exit();
            }
        }

        require './views/frontend/loginView.php';
    }

    public function logout()
    {
        $this->general->logged_only();

        $this->userManager->logout();

        $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";

        header('location: index.php?action=login');

        /*         $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard"; */
    }
    public function account()
    {
        $this->general->logged_only();

        $userId = $_SESSION['auth']->id;

        if (!empty($_POST)) {

            $password = $_POST['password'];
            $passwordConfirm = $_POST['password_confirm'];

            if (empty($password) || empty($passwordConfirm)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";
            } else {

                $this->userManager->changePassword($password, $userId);

                if ($password != $passwordConfirm) {

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

    public function reset()
    {
        /* $this->general->logged_only(); */

        if (empty($_POST['password']) || empty($_POST['password_confirm'])) {

            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            /* header('location: index.php?action=reset&id=' . $_GET['id'] . '&token=' . $_GET['token']); */
        } else {
            $token = $_GET['token'];
            $id = $_GET['id'];
            $password = $_POST['password'];
            $passwordConfirm = $_POST['password_confirm'];

            try {

                $this->userManager->resetPassword($id, $token, $password, $passwordConfirm);
            } catch (Exception $e) {

                $_SESSION['flash']['danger'] = "Ce token n'est pas valide";

                header('location: index.php?action=login');

                exit();
            }

            $_SESSION['flash']['success'] = "Votre mot de passe à bien été modifié";

            header('location: index.php?action=account');

            exit();
        }

        require './views/frontend/resetView.php';
    }
    public function forget()
    {

        if (!empty($_POST)) {
            $mail = $_POST['mail'];

            if (!empty($mail)) {

                try {
                    $this->userManager->forget($mail);
                } catch (Exception $e) {

                    $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse mail';

                    require './views/frontend/forgetView.php';

                    exit();
                }

                $_SESSION['flash']['success'] = "Les instructions du rappel de mot de passe vous ont été envoyés par email";
            }
        }

        require './views/frontend/forgetView.php';
    }

    public function register()
    {
        if (!empty($_POST)) {

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConfirm = $_POST['password_confirm'];

            if (empty($username) || empty($email) || empty($password) || empty($passwordConfirm)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";
            } elseif (password_verify($password, $passwordConfirm)) { } else {

                try {
                    $this->userManager->register($username, $email, $password, $passwordConfirm);
                } catch (Exception $e) {
                    $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs correctement";
                    header('Location: index.php?action=register');
                    exit();
                }

                $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour valider votre compte";

                header('Location: index.php?action=login');

                exit();
            }
        }

        require './views/frontend/registerView.php';
    }

    public function confirmUser()
    {

        if (!empty($_POST)) {

            $userId = $_SESSION['auth']->id;

            $token = $_GET['token'];

            if (empty($token)) {

                $_SESSION['flash']['danger'] = "Veuillez entrer un identifiant valide";
            } else {

                $affectedLines = $this->userManager->confirm($userId, $token);

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
