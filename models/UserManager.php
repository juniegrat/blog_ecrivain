<?php
class UserManager
{

    private $_db;

    public function __construct()
    {

        $pdo = new PDO('mysql:dbname=test;host=localhost', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $this->_db = $pdo;
    }
    public function loginIn($login, $password, $remember)
    {

        $_bdd = setBdd();

        $req = $_bdd->prepare('SELECT * FROM users WHERE username = :username OR email = :username AND confirmed_at IS NOT NULL');

        $req->execute(['username' => $login]);

        $user = $req->fetch();

        session_start();

        if (password_verify($password, $user->password)) {

            $_SESSION['auth'] = $user;

            if ($remember) {

                $remember_token = str_random(250);

                $_bdd->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);

                setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'boi'), time() + 60 * 60 * 24 * 7);

            }

            $affectedLines = true;

        } else {

            $affectedLines = "invalid";

        }

        return $affectedLines;
    }
    public function logout()
    {
        session_start();

        setcookie('remember', null, -1);

        unset($_SESSION['auth']);

        $affectedLines = true;

        return $affectedLines;

    }

    public function forgot($mail)
    {

        $_bdd = setBdd();

        $req = $_bdd->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');

        $req->execute([$mail]);

        $user = $req->fetch();

        if ($user) {

            $reset_token = str_random(60);

            $_bdd->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);

            mail($mail, 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien: \n\nhttp://localhost:8888/blog_ecrivain/index.php?action=reset&id={$user->id}&token=$reset_token");

        } else {

            $affectedLines = "unknownEmail";
        }

        return $affectedLines;
    }

    public function registering($username, $mail, $password, $passwordConfirm)
    {

        $_bdd = setBdd();

        $errors = [];

        if (empty($username) || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {

            $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
        } else {
            $req = $_bdd->prepare('SELECT id FROM users WHERE username = ?');
            $req->execute([$username]);
            $user = $req->fetch();
            if ($user) {
                $errors['username'] = 'Ce pseudo est déjà pris';
            }
        }

        if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre email n'est pas valide";
        } else {
            $req = $_bdd->prepare('SELECT id FROM users WHERE email = ?');
            $req->execute([$mail]);
            $user = $req->fetch();
            if ($user) {
                $errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
            }
        }

        if (empty($password) || $password != $passwordConfirm) {
            $errors['password'] = "Vous devez rentrer un mot de passe valide";
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

    public function confirmUser($userId, $token)
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

    public function resetPassword($id, $token, $password, $passwordConfirm)
    {

        $_bdd = setBdd();

        if (isset($id) && isset($token)) {

            $req = $_bdd->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');

            $req->execute([$id, $token]);

            $user = $req->fetch();

            if ($user) {

                if (!empty($password && $passwordConfirm)) {
                    if (!empty($password) && $password == $passwordConfirm) {

                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                        $affectedLines = $_bdd->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$hashedPassword]);

                    }
                } else {

                    $affectedLines = "empty";

                }
            }
        } else {

            $affectedLines = "invalidToken";

        }

        return $affectedLines;
    }

    public function changePassword($password, $passwordConfirm)
    {

        $_bdd = setBdd();

        session_start();

        if (!empty($password) && $password != $passwordConfirm) {

            $affectedLines = false;
        } else {

            $userId = $_SESSION['auth']->id;

            $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

            $affectedLines = $_bdd->prepare('UPDATE users SET password = ?')->execute([$hashedpassword]);

        }

        return $affectedLines;

    }

}
