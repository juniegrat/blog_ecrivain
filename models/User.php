<?php
class Post
{

    protected $_username,
    $_email,
    $_password,
    $_admin,
    $_remember_token,
    $_confirmation_token,
    $_confirmed_at,
    $_reset_token,
        $_reset_at;

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
}
