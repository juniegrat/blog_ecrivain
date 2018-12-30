<?php
require './controller/frontend/frontend.php';

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
                $_SESSION['flash']['danger'] = "Veuillez entrer un commentaire";
            }
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    } elseif ($_GET['action'] == 'delete') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if ($_GET['category'] === 'news') {
                deletePost($_GET['id']);
            } else {
                deleteComment($_GET['id'], $_GET['postId']);
            }
        }
    } elseif ($_GET['action'] == 'admin') {
        _admin();
    } elseif ($_GET['action'] == 'addPost') {
        if (!empty($_POST['title'] && $_POST['content'])) {
            addPost($_POST['title'], $_POST['content']);
        } else {
            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";
        }
    } elseif ($_GET['action'] == 'edit') {
        _edit($_GET['id']);
    } elseif ($_GET['action'] == 'editPost') {
        editPost($_POST['title'], $_POST['content'], $_GET['id']);
    } elseif ($_GET['action'] == 'add') {
        _add();
    } elseif ($_GET['action'] == 'rateComment') {
        rateComment($_GET['commentId'], $_GET['postId']);
    } elseif ($_GET['action'] == 'logout') {
        logout();
    } elseif ($_GET['action'] == 'account') {
        _account();
    } elseif ($_GET['action'] == 'login') {
        login($_POST['username'], $_POST['password'], $_POST['remember']);
    } elseif ($_GET['action'] == 'loggedIn') {
        _account();
    } elseif ($_GET['action'] == 'forget') {
        _forget();
    } elseif ($_GET['action'] == 'reset') {
        _reset($_GET['id'], $_GET['token']);
    } elseif ($_GET['action'] == 'resetPassword') {
        resetPassword($_GET['id'], $_GET['token'], $_POST['password'], $_POST['password_confirm']);
    } elseif ($_GET['action'] == 'mail') {
        forget($_POST['email']);
    } elseif ($_GET['action'] == 'changePassword') {
        changePassword($_POST['password'], $_POST['password_confirm']);
    } elseif ($_GET['action'] == 'loggin') {
        _login();
    } elseif ($_GET['action'] == 'register') {
        _register();
    } elseif ($_GET['action'] == 'newUser') {
        register($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm']);
    } elseif ($_GET['action'] == 'confirm') {
        confirmUser($_GET['id'], $_GET['token']);
    }
} else {
    _listPosts();
}
