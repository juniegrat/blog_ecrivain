<?php
require './lib/autoload.php';

class CommentController
{

    protected $commentManager;

    public function __construct()
    {

        $this->commentManager = new CommentManager;

    }

    public function _addComment()
    {
        $postId = $_GET['id'];
        $author = $_SESSION['auth']->username;
        $comment = $_POST['comment'];

        if (empty($comment)) {

            $_SESSION['flash']['danger'] = "Veuillez entrer un commentaire";

        } elseif (empty($postId)) {

            $_SESSION['flash']['danger'] = "Identifiant commentaire invalide";

        } else {

            $affectedLines = $this->commentManager->post($postId, $author, $comment);

            if ($affectedLines === false) {

                $_SESSION['flash']['danger'] = "Le commentaire n'a pas pu être posté";

            } else {

                $_SESSION['flash']['success'] = "Le commentaire à bien été posté";

            }

            header('Location: index.php?action=post&id=' . $postId);

        }

    }
    public function _rateComment()
    {
        $commentId = $_GET['commentId'];
        $postId = $_GET['postId'];

        if (!empty($_POST)) {

            if (empty($commentId)) {

                $_SESSION['flash']['danger'] = "Veuillez entrer un identifiant valide";

            } elseif (empty($postId)) {

                $_SESSION['flash']['danger'] = "Veuillez entrer un titre";

            } else {
            }

            $affectedLines = $this->commentManager->rate($commentId, $postId);

            if ($affectedLines === true) {

                $_SESSION['flash']['success'] = "Le commentaire à bien été upvote";

            } else {

                $_SESSION['flash']['danger'] = "Il y eu une erreur veuillez réessayer plus tard";

            }

            header('location: index.php?action=post&id=' . $postId);
        }

    }

    public function _deleteComment()
    {
        $commId = $_GET['id'];
        $postId = $_GET['postId'];

        if (empty($commId) || empty($postId)) {

            $_SESSION['flash']['danger'] = "Veuillez rentrer des identifiants valides";

        } else {

            $affectedLines = $this->commentManager->delete($commId, $postId);

            if ($affectedLines === true) {

                $_SESSION['flash']['success'] = "Le commentaire à bien été supprimé";

            } else {

                $_SESSION['flash']['danger'] = "Il y a eu une erreur veuillez réessayer plus tard";

            }
        }
        header('location: index.php?action=edit&id=' . $postId);

        exit();
    }
}
