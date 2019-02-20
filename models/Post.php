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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        if (!is_string($title) || empty($title)) {
            $this->errors[] = self::INVALID_TITLE;
        } else {
            $this->title = $title;
        }

        return $this;

    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            $this->errors[] = self::INVALID_CONTENT;
        } else {
            $this->content = $content;
        }

        return $this;
    }

    /**
     * Get the value of _dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of dateCreation
     *
     * @return  self
     */
    public function setDateCreation(DATETIME $dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
}
