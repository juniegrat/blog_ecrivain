<?php
require 'Comment.php';
class CommentManager extends General
{

    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->pdo;

    }

    public function add(int $idNews, string $author, string $comment)
    {
        $req = $this->db->prepare('INSERT INTO comments SET id_news = :id_news, author = :author, comment = :comment, date_comment = NOW()');

        $req->execute([
            "id_news" => $idNews,
            "author" => $author,
            "comment" => $comment,
        ]);
    }

    public function findAll(int $idNews, bool $admin = false)
    {
        $commentsList = [];

        $sql = 'SELECT id, id_news AS idNews, author, comment, rating_comment AS ratingComment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS dateComment FROM comments WHERE id_news = ?';

        if ($admin == true) {
            $sql .= "ORDER BY ratingComment DESC";
        } else {
            $sql .= "ORDER BY dateComment DESC";
        }
        $req = $this->db->prepare($sql);

        $req->execute([$idNews]);

        while ($data = $req->fetch()) {
            $commentsList[] = new Comment($data);
        }

        return $commentsList;
    }

    public function rate(int $idComm)
    {

        $req = $this->db->prepare('UPDATE comments SET rating_comment = rating_comment+1 WHERE id = ?');

        $req->execute([$idComm]);

    }

    public function delete(int $idComm)
    {

        $req = $this->db->prepare('DELETE FROM comments WHERE id = ?');

        $req->execute([$idComm]);

    }

}
