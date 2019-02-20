<?php
class Comment
{

    protected $errors,
    $id,
    $idNews,
    $author,
    $comment,
    $dateComment,
        $ratingComment;

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

    /**
     * Méthode permettant de savoir si l'user est nouvelle.
     * @return bool
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * Get the value of _id
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Get the value of _id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of _id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * Get the value of _idNews
     */
    public function getIdNews()
    {
        return $this->idNews;
    }

    /**
     * Set the value of _idNews
     *
     * @return  self
     */
    public function setIdNews($idNews)
    {
        $this->idNews = (int) $idNews;

        return $this;
    }

    /**
     * Get the value of _author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of _author
     *
     * @return  self
     */
    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author)) {
            $this->errors[] = self::INVALID_AUTHOR;
        } else {
            $this->author = $author;
        }

        return $this;
    }

    /**
     * Get the value of _comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of _comment
     *
     * @return  self
     */
    public function setComment($comment)
    {

        if (!is_string($comment) || empty($comment)) {
            $this->errors[] = self::INVALID_COMMENT;
        } else {
            $this->comment = $comment;
        }

        return $this;
    }

    /**
     * Get the value of _dateComment
     */
    public function getDateComment()
    {
        return $this->dateComment;
    }

    /**
     * Set the value of _dateComment
     *
     * @return  self
     */
    public function setDateComment(DATETIME $dateComment)
    {
        $this->dateComment = $dateComment;

        return $this;
    }

    /**
     * Get the value of _ratingComment
     */
    public function getRatingComment()
    {
        return $this->ratingComment;
    }

    /**
     * Set the value of _ratingComment
     *
     * @return  self
     */
    public function setRatingComment($ratingComment)
    {
        $this->ratingComment = (int) $ratingComment;

        return $this;
    }
}
