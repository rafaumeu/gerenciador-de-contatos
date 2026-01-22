<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $letra = $_GET['letra'] ?? '#';
        $this->view('home', ['letraSelecionada' => $letra]);
    }
}
