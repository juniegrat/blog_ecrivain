<?php
require './lib/autoload.php';

class PostController
{

    protected $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager;

    }

    public function _listPosts()
    {
        $this->postManager->lists();
        require './views/frontend/listPostsView.php';
    }

    public function _listPost()
    {
        $postId = $_GET['id'];

        $this->postManager->list($postId);

        require './views/frontend/postView.php';
    }

    public function _admin()
    {
        $this->postManager->lists();

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

                $post = $this->postManager->list($postId);

                $this->postManager->edit($post);

                $_SESSION['flash']['success'] = "L'article à bien été modifié";

                header('location: index.php?action=edit&id=' . $postId);

            }

        }

        $this->postManager->list($postId);

        require './views/frontend/editView.php';
    }

    public function _deletePost()
    {

        $postId = $_GET['id'];

        if (empty($postId)) {

            $_SESSION['flash']['danger'] = "Veuillez rentrer un identifiant valide";

        } else {

            $affectedLines = $this->postManager->delete($postId);

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

            if (empty($postTitle) || empty($postContent)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            } else {

                $this->postManager->add($postTitle, $postContent);

                header('location: index.php?action=admin');

                exit();

            }

        }

        require './views/frontend/addPostView.php';
    }
}
