<?php
class UserManager extends Manager
{

    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->pdo;

    }

    public function str_random($length)
    {

        $alphabet = "01234566789azertyuioopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    public function login(string $login, string $password, bool $remember = false)
    {

        $req = $this->db->prepare('SELECT * FROM users WHERE username = :username OR email = :username AND confirmed_at IS NOT NULL');

        $req->execute(['username' => $login]);

        $user = $req->fetch();

        if (password_verify($password, $user->password)) {

            $_SESSION['auth'] = $user;

            if ($remember) {

                $remember_token = $this->str_random(250);

                $this->db->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);

                setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'boi'), time() + 60 * 60 * 24 * 7);

            }

            $affectedLines = true;

        } else {

            $affectedLines = "invalidCredentials";

        }

        return $affectedLines;
    }
    public function logout()
    {

        setcookie('remember', null, -1);

        unset($_SESSION['auth']);

    }

    public function forget(string $email)
    {

        $req = $this->db->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');

        $req->execute([$email]);

        $user = $req->fetch();

        if ($user) {

            $reset_token = $this->str_random(60);

            $affectedLines = $this->db->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);

            mail($email, 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien: \n\nhttp://localhost:8888/blog_ecrivain/index.php?action=reset&id={$user->id}&token=$reset_token");

        } else {

            $affectedLines = false;

        }

        return $affectedLines;
    }

    public function register(string $username, email $mail, string $password, array $errors)
    {

        $errors = [];

        $req = $this->db->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$username]);
        $user = $req->fetch();
        if ($user) {
            $errors['username'] = 'Ce pseudo est déjà pris';
        }

        $req = $this->db->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$mail]);
        $user = $req->fetch();
        if ($user) {
            $errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
        }

        if (empty($errors)) {

            $req = $this->db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $token = $this->str_random(60);

            $req->execute([$username, $hashedPassword, $mail, $token]);

            $userId = $this->db->lastInsertId();

            mail($mail, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien: \n\nhttp://localhost:8888/blog_ecrivain/index.php?action=confirm&id=$userId&token=$token");

            $affectedLines = true;

        } else {

            $_SESSION['errors'] = $errors;

            $affectedLines = false;
        }

        return $affectedLines;

    }

    public function confirm(int $userId, string $token)
    {

        $req = $this->db->prepare('SELECT * FROM users WHERE id = ?');

        $req->execute([$userId]);

        $user = $req->fetch();

        if ($user && $user->confirmation_token == $token) {

            $affectedLines = $req = $this->db->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$userId]);

        } else {

            $affectedLines = "invalidToken";

        }

        return $affectedLines;
    }

    public function resetPassword(int $userId, string $token, string $password)
    {

        if (isset($userId) && isset($token)) {

            $req = $this->db->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');

            $req->execute([$userId, $token]);

            $user = $req->fetch();

            if ($user) {

                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $affectedLines = $this->db->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?')->execute([$hashedPassword, $id]);

            } else {
                $affectedLines = false;
            }

            return $affectedLines;

        }
    }

    public function changePassword(string $password, int $userId)
    {

        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

        $this->db->prepare('UPDATE users SET password = :password WHERE id = :userId ')->execute([
            "password" => $hashedpassword,
            "userId" => $userId,
        ]);

    }

}
