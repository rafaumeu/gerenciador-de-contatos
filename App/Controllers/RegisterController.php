<?php

namespace App\Controllers;

use Core\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('auth/register', [], 'template/guest');
    }
}
