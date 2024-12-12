<?php

namespace App\Services\Task;

interface ITaskService
{
    public function create($data);
    public function getByOffset(int $page_num);
}