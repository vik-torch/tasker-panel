<?php

namespace App\Services\User;

use App\Models\IUserModel;

interface IUserService
{
    public function create(array $data);
    public function find(int $id);
}