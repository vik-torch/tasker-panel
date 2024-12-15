<?php

namespace App\Controllers\Auth;

use App\Middleware\Auth\Authentification;

class LogoutController extends BaseController
{    
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        Authentification::end_session();
        return $this->view::render('auth.login');
    }
}