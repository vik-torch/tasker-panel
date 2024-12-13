<?php

namespace App\Repositories\Task;

use App\Models\ITaskModel;
use Core\Database\MySQL\Repository as MySQLRepository;
use Core\Exceptions\ServerException;
use Throwable;

class Repository extends MySQLRepository implements ITaskRepository
{
    private const LIMIT = 3;

    public function create(ITaskModel $taskData)
    {
        $sth = $this->dbh->prepare(
            'INSERT INTO `tasks`
                (`text`, `user_id`)
                VALUES (:text, :user_id)'
            );
        $sth->execute([
            ':text' => $taskData->getText(),
            ':user_id' => $taskData->getUserId(),
        ]);

        return $this->dbh->lastInsertId();
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