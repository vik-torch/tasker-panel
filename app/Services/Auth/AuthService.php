<?php

namespace App\Services\Auth;

use App\Models\Auth\UserModel;
use App\Repositories\Auth\IAuthRepository;
use App\Repositories\Auth\Repository;

class AuthService implements IAuthService
{
    private IAuthRepository $authRepository;

    public function __construct()
    {
        $this->authRepository = new Repository();
    }

    public function find(UserModel $userModel): array|false
    {
        $login = $userModel->login;
        $response = $this->authRepository->findBy($login);

        return $response;
    }
}