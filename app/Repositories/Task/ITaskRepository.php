<?php

namespace App\Repositories\Task;

use App\Models\ITaskModel;
use App\Repositories\IPaginateRepository;
use Core\Database\MySQL\IRepository;
use Core\Database\MySQL\OrderEnum;

interface ITaskRepository extends IRepository, IPaginateRepository
{
    public function create(ITaskModel $data);
    public function findAll(
        int $page_num = 0,
        ?string $sort_by = null,
        ?OrderEnum $order = null
    );
}