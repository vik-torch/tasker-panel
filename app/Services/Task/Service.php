<?php

namespace App\Services\Task;

use App\DTO\TaskDTO;
use App\Repositories\Task\Repository as TaskRepository;
use App\Repositories\Task\ITaskRepository;
use App\Models\Task as TaskModel;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\Repository as UserRepository;
use Core\Database\MySQL\OrderValidate;

class Service implements ITaskService
{
    use OrderValidate;

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
     * @param int $page_num - номер страницы
     * @return TaskDTO[]
     */
    public function getByOffset(int $page_num, $sort_by = null, $order = null): array
    {
        $tasks = [];

        $sort_by = match ($sort_by) {
            'status' => 't.status',
            'name' => 'u.name',
            'email' => 'u.email',
            default => null
        };

        static::validateOrder($order, $sort_by);

        $response = $this->taskRepository->findAll($page_num, $sort_by, $order);
        foreach ($response as $raw_task) {
            $task = new TaskDTO(
                $raw_task['id'],
                $raw_task['text'],
                $raw_task['status'],
                $raw_task['name'],
                $raw_task['email']
            );
            $tasks[] = $task;
        };

        return $tasks;
    }
}