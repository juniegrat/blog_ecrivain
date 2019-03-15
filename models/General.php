<?php
require 'Manager.php';
class General extends Manager
{

    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->pdo;
    }

    public function latest()
    {
        return $this->db->lastInsertId();
    }

    public function str_random($length)
    {

        $alphabet = "01234566789azertyuioopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

}
