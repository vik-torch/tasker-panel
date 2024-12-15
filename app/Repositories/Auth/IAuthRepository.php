<?php

namespace App\Repositories\Auth;

interface IAuthRepository
{
    public function findBy(string $login);
}