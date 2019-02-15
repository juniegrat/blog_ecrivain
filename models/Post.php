<?php
class Post
{

    protected $errors = [],
    $_id,
    $_title,
    $_content,
        $_dateCreation;

    const INVALID_TITLE = 1;
    const INVALID_CONTENT = 2;

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
     * Get the value of _title
     */
    public function get_title()
    {
        return $this->_title;
    }

    /**
     * Set the value of _title
     *
     * @return  self
     */
    public function set_title($_title)
    {
        if (!is_string($_title) || empty($_title)) {
            $this->errors[] = self::INVALID_TITLE;
        } else {
            $this->_title = $_title;
        }

        return $this;

    }

    /**
     * Get the value of _content
     */
    public function get_content()
    {
        return $this->_content;
    }

    /**
     * Set the value of _content
     *
     * @return  self
     */
    public function set_content($_content)
    {
        if (!is_string($_content) || empty($_content)) {
            $this->errors[] = self::INVALID_CONTENT;
        } else {
            $this->_content = $_content;
        }

        return $this;
    }

    /**
     * Get the value of _dateCreation
     */
    public function get_dateCreation()
    {
        return $this->_dateCreation;
    }

    /**
     * Set the value of _dateCreation
     *
     * @return  self
     */
    public function set_dateCreation(DATETIME $_dateCreation)
    {
        $this->_dateCreation = $_dateCreation;

        return $this;
    }
}
