<?php
class UserManager extends Manager
{

    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $pdo;

    }

    public function login(User $user)
    {
        $login = $post->getUsername();
        $email = $post->getEmail();
        $password = $post->getPassword();

        $req = $this->db->prepare('SELECT * FROM users WHERE username = :username OR email = :username AND confirmed_at IS NOT NULL');

        $req->execute(['username' => $login]);

        $user = $req->fetch();

        if (password_verify($password, $user->password)) {

            $SESSION['auth'] = $user;

            if ($remember) {

                $remember_token = str_random(250);

                $this->db->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);

                setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'boi'), time() + 60 * 60 * 24 * 7);

            }

        } else {

            throw new Exception($e);

        }

    }

    public function logout()
    {
        setcookie('remember', null, -1);

        unset($SESSION['auth']);

    }

    public function forget(string $mail)
    {

        $req = $this->db->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');

        $req->execute([$mail]);

        $user = $req->fetch();

        if ($user) {

            $reset_token = str_random(60);

            $this->db->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);

            mail($mail, 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien: \n\nhttp://localhost:8888/blog_ecrivain/index.php?action=reset&id={$user->id}&token=$reset_token");

        } else {

            $affectedLines = "unknownEmail";
        }

        return $affectedLines;
    }

    public function register(User $user)
    {

        if (empty($username) || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {

            $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
        } else {
            $req = $this->db->prepare('SELECT id FROM users WHERE username = ?');
            $req->execute([$username]);
            $user = $req->fetch();
            if ($user) {
                $errors['username'] = 'Ce pseudo est déjà pris';
            }
        }

        if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre email n'est pas valide";
        } else {
            $req = $this->db->prepare('SELECT id FROM users WHERE email = ?');
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

            $req = $this->db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $token = str_random(60);

            $req->execute([$username, $hashedPassword, $mail, $token]);

            $userId = $this->db->lastInsertId();

            mail($mail, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien: \n\nhttp://localhost:8888/blog_ecrivain/index.php?action=confirm&id=$userId&token=$token");

            $affectedLines = true;

        } else {

            $SESSION['errors'] = $errors;

            $affectedLines = false;
        }

        return $affectedLines;

    }

    public function confirm($userId, $token)
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

    public function resetPassword($id, $token, $password, $passwordConfirm)
    {

        if (isset($id) && isset($token)) {

            $req = $this->db->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');

            $req->execute([$id, $token]);

            $user = $req->fetch();

            if ($user) {

                if (!empty($password && $passwordConfirm)) {
                    if (!empty($password) && $password == $passwordConfirm) {

                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                        $affectedLines = $this->db->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$hashedPassword]);

                    }
                } else {

                    throw new RuntimeException('empty');

                }
            }
        } else {

            throw new RuntimeException('invalidToken');

        }

        return $affectedLines;
    }

    public function changePassword($password, $passwordConfirm)
    {

        if (!empty($password) && $password != $passwordConfirm) {

            $affectedLines = false;
        } else {

            $userId = $SESSION['auth']->id;

            $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

            $req = $this->db->prepare('UPDATE users SET password = ?')->execute([$hashedpassword]);

        }

        return $req;

    }

}
