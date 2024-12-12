<?php

namespace Core\Database;

class Model
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = Connector::getInstance();
    }
}