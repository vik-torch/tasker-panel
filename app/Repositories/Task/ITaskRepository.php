<?php

namespace App\Repositories\Task;

use App\Models\ITaskModel;
use Core\Database\MySQL\IRepository;

interface ITaskRepository extends IRepository
{
    public function create(ITaskModel $data);
    public function findByOffset(int $page_num);
}