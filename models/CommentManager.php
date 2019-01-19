<?php
class CommentManager
{

    private $_db;

    public function __construct()
    {

        $pdo = new PDO('mysql:dbname=test;host=localhost', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $this->_db = $pdo;
    }

    public function add(Comment $comment)
    {
        $req = $this->_db->prepare('INSERT INTO comments SET id_news = :id_news , author = :author, comment = :comment, date_comment = NOW()');

        $req->execute(array(
            "id_news" => $comment->idNews(),
            "author" => $comment->author(),
            "comment" => $comment->comment(),
        ));
    }
    public function comments(Comment $comment)
    {

        $_bdd = setBdd();

        $req = $_bdd->prepare('SELECT id, author, comment, rating_comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_news = ? ORDER BY date_comment');

        $req->execute([$comment->id()]);

        return $comments;
    }

    public function comment(Comment $comment)
    {
        $_bdd = setBdd();

        $req = $_bdd->prepare('INSERT INTO comments SET id_news = :id_news , author = :author, comment = :comment, date_comment = NOW()');
        $affectedLines = $req->execute(array(
            "id_news" => $comment->id(),
            "author" => $comment->author(),
            "comment" => $comment->comment(),
        ));

        return $affectedLines;
    }

    public function rate(Comment $comment)
    {
        $_bdd = setBdd();

        $Upcomment = $_bdd->prepare('UPDATE comments SET rating_comment = rating_comment+1 WHERE id = ?');

        $affectedLines = $Upcomment->execute([$comment->id()]);

        return $affectedLines;

    }

    public function delete(Comment $comment)
    {
        $_bdd = setBdd();

        $req = $_bdd->prepare('DELETE FROM comments WHERE id = ?');

        $affectedLines = $req->execute([$comment->id()]);

        return $affectedLines;
    }
}
