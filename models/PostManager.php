<?php
class PostManager extends Manager
{

    protected $_db;

    public function __construct()
    {
        parent::__construct();
    }

    public function posts()
    {
        $_db = setBdd();

        $posts = $_db->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news ORDER BY date_creation DESC LIMIT 0, 5');

        return $posts;
    }

    public function post(Post $post)
    {

        $_db = setBdd();

        $post = $_db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM news WHERE id = ?');

        $post->execute($post->id());

        return $post;
    }

    public function add(Post $post)
    {
        $req = $this->_db->prepare('INSERT INTO news SET id = :id , title = :title, content = :content, date_creation = NOW()');

        $req->execute(array(
            "id" => $post->id(),
            "title" => $post->title(),
            "content" => $post->content(),
        ));
    }

    public function edit(Post $post)
    {
        $_db = setBdd();

        session_start();

        if ($post->title()) {
            $affectedLines = "emptyTitle";
        } elseif ($post->content()) {
            $affectedLines = "emptyContent";
        } else {
            $req = $_db->prepare('UPDATE news SET title = :title, content = :cotent WHERE id = :id');

            $req->execute(array(
                "title" => $post->title(),
                "content" => $post->content(),
                "id" => $post->id(),
            ));

            $affectedLines = true;
        }

        return $affectedLines;

    }
    public function delete(Post $post)
    {

        $_db = setBdd();

        $req = $_db->prepare('DELETE FROM news WHERE id = ?');

        $affectedLines = $req->execute(array($post->id()));

        return $affectedLines;
    }

}
