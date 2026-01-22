<?php

namespace App\Controllers;

use Core\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('auth/login', [], 'template/guest');
    }
}
