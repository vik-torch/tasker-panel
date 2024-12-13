<?php

namespace App\Services\User;

use App\Models\IUserModel;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\Repository as UserRepository;

class Service implements IUserService
{
    protected IUserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function find(int $id)
    {
        // TODO: Implement find() method.
    }
}