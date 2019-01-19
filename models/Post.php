<?php
class Post
{

    protected $_id,
    $_title,
    $_content,
        $_dateCreation;

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
