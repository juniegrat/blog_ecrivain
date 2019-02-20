<?php
require './models/frontend.php';

class Frontend
{

    public function listPosts()
    {
        $posts = getPosts();

        require './views/frontend/listPostsView.php';
    }

    public function post()
    {
        $post = listPost($_GET['id']);
        $comments = listComments($_GET['id']);

        require './views/frontend/postView.php';
    }

    public function admin()
    {
        $posts = listPosts();

        require './views/frontend/adminView.php';
    }
    public function edit()
    {
        $post = listPost($_GET['id']);
        $comments = listComments($_GET['id']);

        require './views/frontend/editView.php';
    }

    public function add()
    {
        require './views/frontend/addView.php';
    }

    public function login()
    {
        require './views/frontend/loginView.php';

    }

    public function account()
    {

        require './views/frontend/accountView.php';

    }

    public function reset($id, $token)
    {
        $id = listPost($_GET['id']);
        $token = listComments($_GET['token']);
        require './views/frontend/resetView.php';

    }

    public function forget()
    {

        require './views/frontend/forgetView.php';

    }

    public function register()
    {

        require './views/frontend/registerView.php';

    }

    public function error()
    {

        require './views/frontend/errorView.php';

    }

}
