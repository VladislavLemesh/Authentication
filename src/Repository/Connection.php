<?php

namespace App\Repository;

use PDO;

class Connection
{
    public $pdo;

    function __construct($dbHost, $dbName, $dbUsername, $dbPassword)
    {
        $this->pdo = new PDO(
            "mysql:host=$dbHost;dbname=$dbName",
            $dbUsername,
            $dbPassword
        );
    }
}
