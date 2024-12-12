<?php

namespace App\Repositories\Task;

use Core\Database\IRepository;

interface ITaskRepository extends IRepository
{
    public function create($data);
    public function findByOffset(int $page_num);
}