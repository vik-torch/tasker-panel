<?php

namespace Core\Database;

use Core\Database\Connector;
use PDO;

abstract class Repository implements IRepository
{
    /**
     * DB Handler
     * @var PDO
     */
    protected PDO $dbh;

    public function __construct()
    {
        $this->dbh = Connector::getInstance()->connection;
    }
}