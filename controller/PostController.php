<?php
require './models/frontend.php';

class PostController
{

    public function __construct()
    {

    }

    public function _listPosts()
    {
        lists();

        require './views/frontend/listPostsView.php';
    }

    public function _listPost()
    {
        list($postId);
        lists($postId);

        require './views/frontend/postView.php';
    }

    public function _admin()
    {
       lists();

        require './views/frontend/adminView.php';
    }

    public function _editPost()
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $postId = $_GET['id'];

        if (!empty($_POST)) {

            if (empty($title) || empty($content) || empty($postId)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            } else {

                edit($title, $content, $postId);

                $_SESSION['flash']['success'] = "L'article à bien été modifié";

                header('location: index.php?action=edit&id=' . $postId);

            }

        }

        list($postId);
        lists($postId);

        require './views/frontend/editView.php';
    }

    public function _deletePost()
    {

        $postId = $_GET['id'];

        if (empty($postId)) {

            $_SESSION['flash']['danger'] = "Veuillez rentrer un identifiant valide";

        } else {

            $affectedLines = delete($postId);

            if ($affectedLines === true) {

                $_SESSION['flash']['success'] = "L'article à bien été supprimé";

            } else {

                $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

            }

            header('location: index.php?action=admin');

            exit();

        }
    }

    public function _addPost()
    {
        $postTitle = $_POST['title'];
        $postContent = $_POST['content'];

        if (!empty($_POST)) {

            $validation = true;

            if (empty($postTitle) || empty($postContent)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

                $validation = false;
            }
            if ($validation) {

                add($postTitle, $postContent);

                header('location: index.php?action=admin');

                exit();

            } else {

                $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";
            }
        }

        require './views/frontend/addPostView.php';
    }
}
