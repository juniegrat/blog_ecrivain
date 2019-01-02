<?php
require './models/frontend.php';

/* require './inc/functions.php'; */
function _listPosts()
{
    $posts = getPosts();

    require './views/frontend/listPostsView.php';
}

function _post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require './views/frontend/postView.php';
}

function _addComment($postId, $author, $comment)
{
    $affectedLines = postComment($postId, $author, $comment);
    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function _admin()
{
    $posts = getPosts();

    require './views/frontend/adminView.php';
}
function _edit()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require './views/frontend/editView.php';
}
function _add()
{
    require './views/frontend/addView.php';
}

function _login()
{
    require './views/frontend/loginView.php';

}
function _account()
{

    require './views/frontend/accountView.php';

}

function _forget()
{

    require './views/frontend/forgetView.php';

}

function _register()
{

    require './views/frontend/registerView.php';

}

function _reset($id, $token)
{

    require './views/frontend/resetView.php';

}

function _error()
{

    require './views/frontend/errorView.php';

}
