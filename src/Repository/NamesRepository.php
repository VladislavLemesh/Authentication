<?php

namespace App\Repository;

use App\Model\Names;

class NamesRepository
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $query = 'SELECT * FROM names';
        $tmp = $this->connection->pdo->prepare($query);
        $tmp->execute();
        $data = $tmp->fetchAll();
        $objects = array();
        foreach ($data as $row){
            $objects[] = new Names($row['id'], $row['name'], $row['surname']);
        }
        return $objects;
    }
}
