<?php

namespace App\Repositories\Auth;

use Core\Database\MySQL\Repository as MySQLRepository;

class Repository extends MySQLRepository implements IAuthRepository
{
    public function findBy(string $login)
    {
        $sth = $this->dbh->prepare('SELECT * FROM users WHERE login = :login');
        $sth->execute(['login' => $login]);
        $response = $sth->fetch();

        return $response;
    }
}