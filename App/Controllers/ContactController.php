<?php

namespace App\Controllers;

use Core\Controller;

class ContactController extends Controller
{
    public function index(): void
    {
        $this->view('contatos', [
            'titulo' => 'Contatos',
        ]);
    }
}
