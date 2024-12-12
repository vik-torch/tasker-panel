<?php

namespace App\Controllers;

use App\Models\Test;

class FirstController extends Controller
{
    public function index()
    {
        $test = new Test();
        $response = $test->getAll();
        return 'I`m FirstContrioller!';
    }
}