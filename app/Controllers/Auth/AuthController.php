<?php

namespace App\Controllers\Auth;

use App\Models\Auth\UserModel as User;
use App\Services\Auth\AuthService;
use App\Services\Auth\IAuthService;
use Core\Controller\Controller;
use Core\Exceptions\ClientException;

class AuthController extends Controller
{
    protected IAuthService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new AuthService();
    }

    public function index()
    {
        $login = trim($_POST['login']) ?? null;
        $password = trim($_POST['password']) ?? null;

        if (!$login && !$password) {
            throw new ClientException('Пользователь с такими даннными не найден', 404);
        }
        $user_model = new User($login, $password);
        $user = $this->service->find($user_model);

        if ($user) {
            $_SESSION['is_auth'] = $user['id'];
            // return $this->view::render('auth.login');
            return json_encode(['status' => '200', 'message' => 'Успешная авторизация!']);
        }

        return json_encode(['status' => '401', 'message' => 'Неправильный логин или пароль!']);
    }
}