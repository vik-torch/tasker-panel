<?php

namespace App\Controllers\Auth;

use App\Middleware\Auth\Authentification;

class LoginController extends BaseController
{
    public function index()
    {
        if (Authentification::check_session()) {
            // TODO: Добавить редирект на главную
            return json_encode(['status' => '301', 'message' => 'Вы уже авторизованы! Ща как буудет редирект!!!']);
        }

        return $this->view::render('auth.login');
    }
}