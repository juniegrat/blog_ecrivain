<?php
class CommentManager extends Manager
{

    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $pdo;

    }

    public function add(int $idNews, string $author, string $comment)
    {
        $req = $this->db->prepare('INSERT INTO comments SET id_news = :id_news , author = :author, comment = :comment, date_comment = NOW()');

        $req->execute(array(
            "id_news" => $idNews,
            "author" => $author,
            "comment" => $comment,
        ));
        return $req;
    }

    public function lists(int $id)
    {
        $commentsList = [];

        $req = $this->db->prepare('SELECT id, author, comment, rating_comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_news = ? ORDER BY date_comment');

        $req->execute([$id]);

        while ($data = $req->fetch()) {
            $commentsList[] = new Comment($data);
        }

        return $commentsList;
    }

    public function rate(int $id)
    {

        $req = $this->db->prepare('UPDATE comments SET rating_comment = rating_comment+1 WHERE id = ?');

        $req->execute([$id]);

        return $req;

    }

    public function delete(int $id)
    {

        $req = $this->db->prepare('DELETE FROM comments WHERE id = ?');

        $req->execute([$id]);

        return $req;
    }
}
