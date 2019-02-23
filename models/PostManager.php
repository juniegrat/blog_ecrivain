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
     * @see PostManager::count()
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

    function list(int $postId) {

        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news WHERE id = ?');

        $req->execute($postId);

        $post = new Post($req->fetch());

        $req->closeCursor();

        return $post;
    }

    public function delete(int $postId)
    {

        $req = $this->db->prepare('DELETE FROM news WHERE id = ?');

        $affectedLines = $req->execute(array($postId));

        return $affectedLines;
    }

    public function add(string $title, string $content)
    {

        $req = $this->db->prepare('INSERT INTO news SET title = :title, content = :content, date_creation = NOW()');

        $affectedLines = $req->execute(array(
            "title" => $title,
            "content" => $content,
        ));

        return $affectedLines;
    }

    public function edit(Post $post)
    {

        $req = $this->db->prepare('UPDATE news SET title = :title, content = :content WHERE id = :postId');

        $affectedLines = $req->execute([
            "title" => (string) $post->getTitle(),
            "content" => (string) $post->getContent(),
            "id" => (int) $post->getId(),
        ]);

        return $affectedLines;

    }

}
