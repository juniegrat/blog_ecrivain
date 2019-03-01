<?php
require './models/PostManager.php';
/* require './models/CommentManager.php'; */
class PostController
{

    protected $postManager;
    protected $commentManager;

    public function __construct()
    {
        $this->postManager = new PostManager;
        $this->commentManager = new CommentManager;

    }

    public function listPosts()
    {
        $posts = $this->postManager->findAll();
        require './views/frontend/listPostsView.php';
    }

    public function listPost()
    {
        $postId = $_GET['id'];

        $posts = $this->postManager->find($postId);

        $comments = $this->commentManager->findAll($postId);

        require './views/frontend/postView.php';
    }

    public function admin()
    {
        $posts = $this->postManager->findAll();

        require './views/frontend/adminView.php';
    }

    public function editPost()
    {
        $postId = $_GET['id'];

        if (!empty($_POST)) {
            $title = $_POST['title'];
            $content = $_POST['content'];

            if (empty($title) || empty($content) || empty($postId)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            } else {

                $this->postManager->edit($title, $content, $postId);

                $_SESSION['flash']['success'] = "L'article à bien été modifié";

                header('location: index.php?action=editPost&id=' . $postId);

            }

        }

        $posts = $this->postManager->find($postId);
        $comments = $this->commentManager->findAll($postId);

        require './views/frontend/editPostView.php';
    }

    public function deletePost()
    {

        $postId = $_GET['id'];

        if (empty($postId)) {

            $_SESSION['flash']['danger'] = "Veuillez rentrer un identifiant valide";

        } else {

            $this->postManager->delete($postId);

            $_SESSION['flash']['success'] = "L'article à bien été supprimé";

            /* $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard"; */

            header('location: index.php?action=admin');

            exit();

        }
    }

    public function addPost()
    {

        if (!empty($_POST)) {
            $postTitle = $_POST['title'];
            $postContent = $_POST['content'];

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
