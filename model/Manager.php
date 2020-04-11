<?php

namespace Openclassrooms\Blog\Model;

require('model/config.php');

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO(DB_HOST, DB_USER, DB_PASS);
        return $db;
    }
}