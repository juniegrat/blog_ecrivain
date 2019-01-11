<?php
class Comment
{

    private $_id;
    private $_idNews;
    private $_author;
    private $_comment;
    private $_dateComment;
    private $_ratingComment;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        if (isset($data["id"])) {
            $this->setId($data["id"]);
        }
        if (isset($data["id_news"])) {
            $this->setIdNews($data["id_news"]);
        }
        if (isset($data["author"])) {
            $this->setAuthor($data["author"]);
        }
        if (isset($data["comment"])) {
            $this->setComment($data["comment"]);
        }
        if (isset($data["date_comment"])) {
            $this->setDateComment($data["date_comment"]);
        }
        if (isset($data["rating_comment"])) {
            $this->setRatingComment($data["rating_comment"]);
        }
    }

    /* Getter */
    public function id()
    {
        return $this->_id;
    }

    public function idNews()
    {
        return $this->_idNews;
    }

    public function author()
    {
        return $this->_author;
    }

    public function comment()
    {
        return $this->_comment;
    }

    public function dateComment()
    {
        return $this->_dateComment;
    }

    public function ratingComment()
    {
        return $this->_ratingComment;
    }

    /* Setter */

    public function setId($id)
    {
        $id = (int) $id;

        if (is_int($id) && $id > 0) {
            $this->_id = $id;
        }
    }
    public function setIdNews($idNews)
    {
        $this->_idNews = $idNews;
    }
    public function setAuthor($author)
    {
        $this->_author = $author;
    }
    public function setComment($comment)
    {
        $this->_comment = $comment;
    }
    public function setDateComment($dateComment)
    {
        $this->_dateComment = $dateComment;
    }
    public function setRatingComment($ratingComment)
    {
        $this->_ratingComment = $ratingComment;
    }

}
