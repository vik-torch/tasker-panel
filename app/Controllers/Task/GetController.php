<?php

namespace App\Controllers\Task;

class GetController extends BaseController
{
    public function index()
    {
        $offset = (int)$_GET['offset'] ?? 0;
        $tasks = $this->taskService->getByOffset($offset);

        // return $this->view::render('task', compact('tasks'));
        return json_encode($tasks);
    }
}