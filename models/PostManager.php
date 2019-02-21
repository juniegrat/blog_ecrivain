<?php
class PostManager extends Manager
{

    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $pdo;
    }

    /**
     * @see NewsManager::count()
     */
    public function count()
    {
        return $this->db->query('SELECT id FROM post')->num_rows;
    }

    public function lists(int $start = -1, int $limit = -1)
    {
        $postsList = [];

        if ($start != -1 || $limit != -1) {
            $req = $this->db->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news ORDER BY date_creation DESC LIMIT ' . (int) $limit . ' OFFSET ' . (int) $start);
        }

        while ($data = $req->fetch()) {
            $postsList[] = new Post($data);
        }

        $req->closeCursor();

        return $postsList;
    }

    function list(int $id) {

        $postList = [];

        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news WHERE id = ?');

        $req->execute($id);

        while ($data = $req->fetch()) {
            $postList[] = new Post($data);
        }
        $req->closeCursor();

        return $postList;
    }

    public function add(int $id, string $title, string $content)
    {
        $req = $this->db->prepare('INSERT INTO news SET id = :id , title = :title, content = :content, date_creation = NOW()');

        $req->execute([
            "id" => $id,
            "title" => $title,
            "content" => $content,
        ]);

        return $req;
    }

    public function edit(Post $post)
    {

        $req = $this->db->prepare('UPDATE news SET title = :title, content = :content WHERE id = :id');

        $req->execute([
            "title" => (string) $post->getTitle(),
            "content" => (string) $post->getContent(),
            "id" => (int) $post->getId(),
        ]);

        return $req;
    }

    public function delete(int $id)
    {

        $req = $this->db->prepare('DELETE FROM news WHERE id = ?');

        $req->execute([$id]);

        return $req;
    }

}
