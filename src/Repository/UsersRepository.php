<?php

namespace App\Repository;

use App\Model\User;

class UsersRepository
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function findUser($login)
    {
        $query = 'SELECT * FROM users WHERE login = :login';
        $tmp = $this->connection->pdo->prepare($query);
        $tmp->execute(['login' => $login]);
        $data = $tmp->fetchAll();
        if (!empty($data)) {
            return new User($login, $data[0]['password']);
        }
        else {
            return null;
        }
    }

    public function addUser($login, $password)
    {
        if ($this->findUser($login) == null)
        {
            $query = 'INSERT INTO users(login, password) VALUES(:login, :password)';
            $tmp = $this->connection->pdo->prepare($query);
            $tmp->execute(['login' => $login, 'password' => $password]);
        }
    }
}
