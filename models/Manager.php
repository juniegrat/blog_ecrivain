<?php
class Manager
{
    protected function __construct()
    {

        $pdo = new PDO('mysql:dbname=test;host=localhost', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $this->_db = $pdo;

    }

}
