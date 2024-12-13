<?php

namespace App\Services\Task;

use App\Models\ITaskModel;
use App\Repositories\Task\Repository as TaskRepository;
use App\Repositories\Task\ITaskRepository;
use App\Models\Task as TaskModel;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\Repository as UserRepository;

class Service implements ITaskService
{
    private ITaskRepository $taskRepository;
    private IUserRepository $userRepository;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
        $this->userRepository = new UserRepository();
    }

    public function create($text, $user_name, $user_email)
    {
        try {
            $this->taskRepository->beginTransaction();

            $user_model = new User($user_name, $user_email);
            $user_id = $this->userRepository->findIdBy($user_email);
            if (!$user_id) {
                $user_id =$this->userRepository->create($user_model);
            }
            
            $task_model = new TaskModel($text, $user_id);
            $this->taskRepository->create($task_model);

            $this->taskRepository->commit();
        } catch (\Throwable $e) {
            $this->taskRepository->rollBack();
            throw $e;
        }
    }

    /**
     * Summary of getByOffset
     * @param int $page_num - номер страницы >= 0
     * @return TaskModel[]
     */
    public function getByOffset(int $page_num)
    {
        $tasks = [];

        $response = $this->taskRepository->findByOffset($page_num);
        foreach ($response as $raw_task) {
            $task = new TaskModel(
                $raw_task['text'],
                $raw_task['status'],
                $raw_task['user_id'],
                $raw_task['id']
            );
            $tasks[] = $task;
        };

        return $tasks;
    }
}