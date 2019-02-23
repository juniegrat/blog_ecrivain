<?php

require './controller/frontend/frontend.php';

switch ($_GET['action']) {

    case "listPosts":
        _listPosts();
        break;

    case "post":
        if (!empty($_GET['id']) && $_GET['id'] > 0) {
            _listPost();
        } else {
            $_SESSION['flash']['danger'] = "Identifiant de billet invalide";
        }
        break;

    case "addComment":
        if (!empty($_GET['id']) && $_GET['id'] > 0) {
            _addComment();
        } else {
            $_SESSION['flash']['danger'] = "Identifiant de billet invalide";
        }
        break;

    case "delete":
        if (!empty($_GET['id']) && $_GET['id'] > 0) {
            if ($_GET['category'] === 'news') {
                _deletePost();
            } else {
                _deleteComment();
            }
        } else {
            $_SESSION['flash']['danger'] = "Identifiant de billet invalide";
        }
        break;

    case "admin":
        _admin();
        break;

    case "editPost":
        _editPost();
        break;

    case "addPost":
        _addPost();
        break;

    case "rateComment":
        _rateComment();
        break;

    case "lougout":
        _lougout();
        break;

    case "account":
        _account();
        break;

    case "login":
        _login();
        break;

    case "forget" || "mail":
        _forget();
        break;

    case "reset":
        _reset();
        break;

    case "resetPassword":
        if (!empty($_GET['id']) && !empty($_GET['token'])) {
            _resetPassword();
        } else {
            $_SESSION['flash']['danger'] = "Token ou identifiant invalide";
        }
        break;

    case "login":
        _login();
        break;

    case "register" || "newUser":
        _register();
        break;

    case "confirm":
        if (!empty($_GET['id']) && !empty($_GET['token'])) {
            _confirmUser();
        } else {
            $_SESSION['flash']['danger'] = "Token ou identifiant invalide";
        }
        break;

    case "error":
        _error();
        break;

    default:
        _listPosts();
        break;

}

/* if (!empty($_GET['action'])) {
if ($_GET['action'] == 'listPosts') {
_listPosts();
} elseif ($_GET['action'] == 'post') {
if (!empty($_GET['id']) && $_GET['id'] > 0) {
_listPost();
} else {
$_SESSION['flash']['danger'] = "Identifiant de billet invalide";
}
} elseif ($_GET['action'] == 'addComment') {
if (!empty($_GET['id']) && $_GET['id'] > 0) {
_addComment();
} else {
$_SESSION['flash']['danger'] = "Identifiant de billet invalide";
}
} elseif ($_GET['action'] == 'delete') {
if (!empty($_GET['id']) && $_GET['id'] > 0) {
if ($_GET['category'] === 'news') {
_deletePost();
} else {
_deleteComment();
}
} else {
$_SESSION['flash']['danger'] = "Identifiant de billet invalide";
}
} elseif ($_GET['action'] == 'admin') {
_admin();
} elseif ($_GET['action'] == 'editPost') {
_editPost();
} elseif ($_GET['action'] == 'addPost') {
_addPost();
} elseif ($_GET['action'] == 'rateComment') {
_rateComment();
} elseif ($_GET['action'] == 'logout') {
_logout();
} elseif ($_GET['action'] == 'account') {
_account();
} elseif ($_GET['action'] == 'login') {
_login();
} elseif ($_GET['action'] == 'forget' || $_GET['action'] == 'mail') {
_forget();
} elseif ($_GET['action'] == 'reset') {
_reset();
} elseif ($_GET['action'] == 'resetPassword') {
if (!empty($_GET['id']) && !empty($_GET['token'])) {
_resetPassword();
} else {
$_SESSION['flash']['danger'] = "Token ou identifiant invalide";
}
} elseif ($_GET['action'] == 'loggin') {
_login();
} elseif ($_GET['action'] == 'register' || $_GET['action'] == 'newUser') {
_register();
} elseif ($_GET['action'] == 'confirm') {
if (!empty($_GET['id']) && !empty($_GET['token'])) {
_confirmUser();
} else {
$_SESSION['flash']['danger'] = "Token ou identifiant invalide";
}
} elseif ($_GET['action'] == 'error') {
_error();
}
} else {
_listPosts();
} */
