<?php

namespace App\Repositories\Task;

use Core\Database\MySQL\Repository as MySQLRepository;
use Core\Exceptions\ServerException;
use PDO;
use Throwable;

class Repository extends MySQLRepository implements ITaskRepository
{
    private const LIMIT = 3;

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function findByOffset(int $page_num = 0)
    {
        $offset = $page_num * self::LIMIT;

        $response = static::tryExecute(function () use ($offset) {
            $sth = $this->dbh->prepare('SELECT * FROM `tasks` LIMIT :limit OFFSET :offset');

            $sth->execute(['limit' => self::LIMIT, 'offset' => $offset]);
            $response = $sth->fetchAll();
            return $response;
        });

        return $response;
    }

    private static function tryExecute(callable $callback)
    {
        try {
            $response = $callback();
        } catch (Throwable $e) {
            // throw new ServerException();
            throw $e;
        }
        
        return $response;
    }
}