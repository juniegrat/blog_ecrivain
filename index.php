<?php
require './controller/frontend/frontend.php';

/* switch ($_GET['action']) {
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
case "listPosts":
_listPosts();
break;
} */

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        _listPosts();
    } elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            _post();
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    } elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['comment'])) {
                _addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            } else {
                session_start();
                $_SESSION['flash']['danger'] = "Veuillez entrer un commentaire";
                _post();
            }
        } else {
            session_start();
            $_SESSION['flash']['danger'] = "Aucun identifiant de billet envoyé";
        }
    } elseif ($_GET['action'] == 'delete') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if ($_GET['category'] === 'news') {
                _deletePost($_GET['id']);
            } else {
                _deleteComment($_GET['id'], $_GET['postId']);
            }
        }
    } elseif ($_GET['action'] == 'admin') {
        _admin();
    } elseif ($_GET['action'] == 'addPost') {
        if (!empty($_POST['title'] && $_POST['content'])) {
            _addPost($_POST['title'], $_POST['content']);
        } else {
            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";
        }
    } elseif ($_GET['action'] == 'edit') {
        _edit($_GET['id']);
    } elseif ($_GET['action'] == 'editPost') {
        _editPost($_POST['title'], $_POST['content'], $_GET['id']);
    } elseif ($_GET['action'] == 'add') {
        _add();
    } elseif ($_GET['action'] == 'rateComment') {
        _rateComment($_GET['commentId'], $_GET['postId']);
    } elseif ($_GET['action'] == 'logout') {
        _logout();
    } elseif ($_GET['action'] == 'account') {
        _account();
    } elseif ($_GET['action'] == 'login') {
        _loginIn($_POST['username'], $_POST['password'], $_POST['remember']);
    } elseif ($_GET['action'] == 'loggedIn') {
        _account();
    } elseif ($_GET['action'] == 'forget') {
        _forget();
    } elseif ($_GET['action'] == 'reset') {
        _reset();
    } elseif ($_GET['action'] == 'resetPassword') {
        _resetPassword($_GET['id'], $_GET['token'], $_POST['password'], $_POST['password_confirm']);
    } elseif ($_GET['action'] == 'mail') {
        _forgot($_POST['email']);
    } elseif ($_GET['action'] == 'changePassword') {
        _changePassword($_POST['password'], $_POST['password_confirm']);
    } elseif ($_GET['action'] == 'loggin') {
        _login();
    } elseif ($_GET['action'] == 'register') {
        _register();
    } elseif ($_GET['action'] == 'newUser') {
        _registering($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm']);
    } elseif ($_GET['action'] == 'confirm') {
        _confirmUser($_GET['id'], $_GET['token']);
    } elseif ($_GET['action'] == 'error') {
        _error();
    }
} else {
    _listPosts();
}
