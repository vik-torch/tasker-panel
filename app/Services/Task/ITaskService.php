<?php

namespace App\Services\Task;

interface ITaskService
{
    public function create($text, $user_name, $user_email);
    public function getByOffset(int $page_num, $sort_by = null, $order = null);
}