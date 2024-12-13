<?php

namespace App\Services\Task;

use App\Models\ITaskModel;

interface ITaskService
{
    public function create($text, $user_name, $user_email);
    public function getByOffset(int $page_num);
}