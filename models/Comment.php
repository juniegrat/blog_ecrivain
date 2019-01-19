<?php
class Comment
{

    protected $_id,
    $_idNews,
    $_author,
    $_comment,
    $_dateComment,
        $_ratingComment;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $attr => $value) {
            $method = 'set' . ucfirst($attr);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
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
