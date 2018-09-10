<?php

function debug($variable)
{

    echo '<pre>' . print_r($variable, true) . '</pre>';

}

function str_random($length)
{

    $alphabet = "01234566789azertyuioopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function logged_only()
{

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['auth'])) {

        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";

        header('location: login.php');

        exit();
    }

}

function admin_only(){

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['auth']->admin == 0) {

        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";

        header('location: login.php');

        exit();
    }
}

function reconnect_from_cookie()
{

    if (session_status() == PHP_SESSION_NONE) {

        session_start();
    }

    if (isset($_COOKIE['remember']) && !isset($_SESSION['auth'])) {

        require_once 'db.php';

        if(!isset($pdo)){

            global $pdo;

        }

        $remember_token = $_COOKIE['remember'];

        $parts = explode('==', $remember_token);

        $user_id = $parts[0];

        $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');

        $req->execute([$user_id]);

        $user = $req->fetch();

        if ($user) {

            $expected = $user->id . '==' . $user->remember_token . sha1($user->id . 'boi');

            if ($expected == $remember_token) {

                session_start();

                $_SESSION['auth'] = $user;

                setcookie('remember',$remember_token,  time() + 60 * 60 * 24 * 7);

                 unset($_SESSION['flash']);

                header('location: account.php');


            }else{
                setcookie('remember',null, -1);
            }

        }
    }
}