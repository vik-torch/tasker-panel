<?php

namespace App\Repositories\Task;

use App\Models\ITaskModel;
use Core\Database\MySQL\Repository as MySQLRepository;
use Core\Exceptions\ServerException;
use Throwable;
use Core\Database\MySQL\OrderEnum;

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
            $sth = $this->dbh->prepare(
                'SELECT * FROM `tasks` LIMIT :limit OFFSET :offset'
            );

            $sth->execute(['limit' => self::LIMIT, 'offset' => $offset]);
            $response = $sth->fetchAll();
            return $response;
        });

        return $response;
    }

    public function findAll(
        int $page_num = 1,
        ?string $sort_by = null,
        ?OrderEnum $order = null
    ) {
        $offset = ($page_num - 1) * self::LIMIT;
        $query = 'SELECT 
                t.id,
                t.text,
                t.status,
                u.name,
                u.email
                FROM `tasks` t
                JOIN `users` u ON t.user_id = u.id
                LIMIT :limit OFFSET :offset';

        $replace_params = [
            ':limit' => self::LIMIT,
            ':offset' => $offset
        ];

        if ($sort_by) {
            $query =str_replace('LIMIT', 'ORDER BY ' . $sort_by . ' ' . $order->value . ' LIMIT', $query);
        }

        $response = static::tryExecute(function () use ($query, $replace_params) {
            $sth = $this->dbh->prepare($query);

            $sth->execute($replace_params);
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