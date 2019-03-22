<?php
require './models/CommentManager.php';
class CommentController
{

    protected $commentManager;
    protected $general;

    public function __construct()
    {

        $this->commentManager = new CommentManager;
        $this->general = new General;

    }

    public function listComment()
    {
        $postId = $_GET['id'];

        if (empty($postId)) {

            $_SESSION['flash']['danger'] = "Identifiant commentaire invalide";

        } else {

            $this->commentManager->findAll($postId);

        }

    }

    public function addComment()
    {
        $this->general->logged_only();

        $postId = $_GET['id'];
        $author = $_SESSION['auth']->username;

        if (empty($postId)) {

            $_SESSION['flash']['danger'] = "Identifiant commentaire invalide";

        } else {

            $comment = $_POST['comment'];

            if (empty($comment)) {

                $_SESSION['flash']['danger'] = "Veuillez entrer un commentaire";

            }

            $this->commentManager->add($postId, $author, $comment);

            /*$_SESSION['flash']['danger'] = "Le commentaire n'a pas pu être posté"; */

            $_SESSION['flash']['success'] = "Le commentaire à bien été posté";

        }
        header('Location: index.php?action=post&id=' . $postId);

    }
    public function rateComment()
    {
        $this->general->logged_only();

        $commentId = $_GET['commentId'];
        $postId = $_GET['postId'];

        if (!empty($_POST)) {

            if (empty($commentId)) {

                $_SESSION['flash']['danger'] = "Veuillez entrer un identifiant valide";

            } elseif (empty($postId)) {

                $_SESSION['flash']['danger'] = "Veuillez entrer un titre";

            } else {
            }

            $this->commentManager->rate($commentId, $postId);

            $_SESSION['flash']['success'] = "Le commentaire à bien été upvote";

            /* $_SESSION['flash']['danger'] = "Il y eu une erreur veuillez réessayer plus tard"; */

            header('location: index.php?action=post&id=' . $postId);
        }

    }

    public function deleteComment()
    {
        $this->general->logged_only();

        $commId = $_GET['id'];
        $postId = $_GET['postId'];

        if (empty($commId) || empty($postId)) {

            $_SESSION['flash']['danger'] = "Veuillez rentrer des identifiants valides";

        } else {

            $this->commentManager->delete($commId, $postId);

            $_SESSION['flash']['success'] = "Le commentaire à bien été supprimé";

            /* $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard"; */

        }
        header('location: index.php?action=editPost&id=' . $postId);

        exit();
    }
}
