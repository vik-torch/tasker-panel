<?php

namespace App\Controllers\Task;

class GetController extends BaseController
{
    public function index()
    {
        $offset = (int)$_GET['offset'] ?? 0;
        $sort_by = $_GET['sort_by'] ?? null;
        $order = $_GET['order'] ?? null;
        
        $tasks = $this->taskService->getByOffset($offset, $sort_by, $order);

        // return $this->view::render('task', compact('tasks'));
        return json_encode($tasks);
    }
}