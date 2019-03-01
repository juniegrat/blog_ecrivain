<?php
class Manager
{
    public $pdo;
    protected function __construct()
    {

        $this->pdo = new PDO('mysql:dbname=test;host=localhost', 'root', 'root', []);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    }

}
