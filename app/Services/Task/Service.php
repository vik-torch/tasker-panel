<?php

namespace App\Services\Task;

use App\Repositories\Task\Repository;
use App\Repositories\Task\ITaskRepository;
use App\Models\Task as TaskModel;

class Service implements ITaskService
{
    private ITaskRepository $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    /**
     * Summary of getByOffset
     * @param int $page_num - номер страницы >= 0
     * @return TaskModel[]
     */
    public function getByOffset(int $page_num)
    {
        $tasks = [];

        $response = $this->repository->findByOffset($page_num);
        foreach ($response as $raw_task) {
            $task = new TaskModel(
                $raw_task['id'],
                $raw_task['text'],
                $raw_task['status']
            );
            $tasks[] = $task;
        };

        return $tasks;
    }
}