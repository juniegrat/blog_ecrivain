<?php
class Comment
{

    protected $errors = [];
    protected $id;
    protected $idNews;
    protected $author;
    protected $comment;
    protected $dateComment;
    protected $ratingComment;

    const INVALID_AUTHOR = "Auteur invalide";
    const INVALID_COMMENT = "Veuillez remplir tout les champs";

    public function __construct(stdClass $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(stdClass $data)
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
        $this->id = (int)$id;

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
        $this->idNews = (int)$idNews;

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
            /*  */
            /* $this->errors[] = self::INVALID_AUTHOR; */ } else {
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
            /* throw new Exception(self::INVALID_COMMENT); */
            /* $this->errors[] = self::INVALID_COMMENT; */ } else {
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
    public function setDateComment($dateComment)
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
        $this->ratingComment = (int)$ratingComment;

        return $this;
    }
}
