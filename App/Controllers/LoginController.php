<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\Session;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('auth/login', [], 'template/guest');
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email)) {
            flash('errors', ['email' => 'O e-mail é obrigatório!']);
            flash('old', ['email' => $email]);
            redirect('/login');
        }

        if (empty($password)) {
            flash('errors', ['password' => 'A senha é obrigatória!']);
            flash('old', ['email' => $email]);
            redirect('/login');
        }

        $userModel = new User;
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            Session::put('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ]);

            flash('success', 'Bem vindo de volta, '.$user['name'].'!');
            redirect('/');
        }
        $errors = [];
        $errors['email'] = 'Email ou senha inválidos!';
        flash('errors', $errors);
        flash('old', ['email' => $email]);
        redirect('/login');
    }

    public function logout(): void
    {
        Session::destroy();
        redirect('/login');
    }
}
