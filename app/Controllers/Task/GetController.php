<?php

namespace App\Controllers\Task;

use Core\Exceptions\ClientException;

class GetController extends BaseController
{
    public function index()
    {
        $offset = (int)$_GET['page'] ?? 1;
        $offset = $offset < 1 ? 1 : $offset;
        
        $sort_by = $_GET['sort_by'] ?? null;
        $order = $_GET['order'] ?? null;
        
        $tasks = $this->taskService->getByOffset($offset, $sort_by, $order);

        // return $this->view::render('task', compact('tasks'));
        return json_encode($tasks);
    }
}