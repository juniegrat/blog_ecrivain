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
}
