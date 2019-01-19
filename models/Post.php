<?php
class Post
{

    private $_id;
    private $_title;
    private $_content;
    private $_dateCreation;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        if (isset($data["id"])) {
            $this->setId($data["id"]);
        }
        if (isset($data["title"])) {
            $this->setTitle($data["title"]);
        }
        if (isset($data["content"])) {
            $this->setContent($data["content"]);
        }
        if (isset($data["date_creation"])) {
            $this->setDateCreation($data["date_creation"]);
        }
    }

    /* Getter */
    public function id()
    {
        return $this->_id;
    }

    public function title()
    {
        return $this->_title;
    }

    public function content()
    {
        return $this->_content;
    }

    public function dateCreation()
    {
        return $this->_dateCreation;
    }

    /* Setter */

    public function setId($id)
    {
        $id = (int) $id;

        if (is_int($id) && $id > 0) {
            $this->_id = $id;
        }
    }
    public function setTitle($title)
    {
        $this->_title = $title;
    }
    public function setContent($content)
    {
        $this->_content = $content;
    }
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }
}
