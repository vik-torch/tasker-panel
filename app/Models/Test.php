<?php

namespace App\Models;

use Core\Database\Model;
use PDO;

class Test extends Model
{
    public function get()
    {
        $response = $this->dbh->connection->query('SELECT * FROM test')->fetch(PDO::FETCH_ASSOC);
        return $response;
    }

    public function getAll()
    {
        $response = $this->dbh->connection->query('SELECT * FROM test')->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
}