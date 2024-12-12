<?php

namespace Core\Database\MySQL;

use Core\Database\Connector;
use Core\Database\IRepository;
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