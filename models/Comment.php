<?php
class Comment
{

    protected $_errors,
    $_id,
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
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     *
     * @return  self
     */
    public function set_id($_id)
    {
        $this->_id = (int) $_id;

        return $this;
    }

    /**
     * Get the value of _idNews
     */
    public function get_idNews()
    {
        return $this->_idNews;
    }

    /**
     * Set the value of _idNews
     *
     * @return  self
     */
    public function set_idNews(_ $idNews)
    {
        $this->_idNews = (int) $_idNews;

        return $this;
    }

    /**
     * Get the value of _author
     */
    public function get_author()
    {
        return $this->_author;
    }

    /**
     * Set the value of _author
     *
     * @return  self
     */
    public function set_author($_author)
    {
        if (!is_string($_author) || empty($_author)) {
            $this->errors[] = self::INVALID_AUTHOR;
        } else {
            $this->_author = $_author;
        }

        return $this;
    }

    /**
     * Get the value of _comment
     */
    public function get_comment()
    {
        return $this->_comment;
    }

    /**
     * Set the value of _comment
     *
     * @return  self
     */
    public function set_comment($_comment)
    {

        if (!is_string($_comment) || empty($_comment)) {
            $this->errors[] = self::INVALID_COMMENT;
        } else {
            $this->_comment = $_comment;
        }

        return $this;
    }

    /**
     * Get the value of _dateComment
     */
    public function get_dateComment()
    {
        return $this->_dateComment;
    }

    /**
     * Set the value of _dateComment
     *
     * @return  self
     */
    public function set_dateComment(DATETIME $_dateComment)
    {
        $this->_dateComment = $_dateComment;

        return $this;
    }

    /**
     * Get the value of _ratingComment
     */
    public function get_ratingComment()
    {
        return $this->_ratingComment;
    }

    /**
     * Set the value of _ratingComment
     *
     * @return  self
     */
    public function set_ratingComment($_ratingComment)
    {
        $this->_ratingComment = (int) $_ratingComment;

        return $this;
    }
}
