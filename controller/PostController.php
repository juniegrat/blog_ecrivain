<?php
require './models/PostManager.php';
require './models/Post.php';
/* require './models/CommentManager.php'; */
class PostController
{

    protected $postManager;
    protected $commentManager;
    protected $general;

    public function __construct()
    {
        $this->postManager = new PostManager;
        $this->commentManager = new CommentManager;
        $this->general = new General;

    }

    public function listPosts()
    {
        $posts = $this->postManager->findAll();
        require './views/frontend/listPostsView.php';
    }

    public function listPost()
    {
        $postId = $_GET['id'];

        try {
            $post = $this->postManager->find($postId);

            /* throw new Exception(); */

        } catch (Exception $e) {
            $_SESSION['flash']['danger'] = "Aucun article ne correspond à cet identifiant";
            header('location:index.php?action=listPosts');
            exit();
        }
        $comments = $this->commentManager->findAll($postId);
        require './views/frontend/postView.php';
    }

    public function admin()
    {
        $this->general->admin_only();

        $posts = $this->postManager->findAll();

        require './views/frontend/adminView.php';
    }

    public function editPost()
    {
        $this->general->admin_only();

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
        try {
            $post = $this->postManager->find($postId);
            $comments = $this->commentManager->findAll($postId);
        } catch (Exception $e) {
            $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";
        } finally {
            require './views/frontend/editPostView.php';
        }
    }

    public function deletePost()
    {
        $this->general->admin_only();

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
        $this->general->admin_only();

        if (!empty($_POST)) {
            $postTitle = $_POST['title'];
            $postContent = $_POST['content'];

            if (empty($postTitle) || empty($postContent)) {

                $_SESSION['flash']['danger'] = "Veuillez remplir tout les champs";

            } else {

                $this->postManager->add($postTitle, $postContent);

                $id = $this->postManager->latest();

                $_SESSION['flash']['success'] = "Le post à bien été ajouté";

                header('location: index.php?action=editPost&id=' . $id);

                exit();

            }

        }

        require './views/frontend/addPostView.php';
    }
}
