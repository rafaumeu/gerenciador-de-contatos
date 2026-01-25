<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\Session;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('auth/register', [], 'template/guest');
    }

    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm-password'] ?? '';
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'O nome é obrigatório';
        }
        if (empty($email)) {
            $errors['email'] = 'O email é obrigatório';
        } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Formato de email invalido';
        } else {
            $userModel = new User;
            if ($userModel->findByEmail($email)) {
                $errors['email'] = 'Este email ja está em uso';
            }
        }
        if (empty($password)) {
            $errors['password'] = 'A senha é obrigatória.';
        } else {
            // Cálculo de força (Réplica do Frontend)
            $score = 0;
            if (strlen($password) > 7) {
                $score += 30;
            }
            if (preg_match('/[A-Z]/', $password)) {
                $score += 20;
            }
            if (preg_match('/[0-9]/', $password)) {
                $score += 20;
            }
            if (preg_match('/[^A-Za-z0-9]/', $password)) {
                $score += 30;
            }
            if ($score < 50) {
                $errors['password'] = 'Senha muito fraca! A senha deve conter minimo de 8 caracteres, uma letra maiúscula, um número e um caractere especial';
            }
        }
        if ($password !== $confirm) {
            $errors['confirm-password'] = 'As senhas não coincidem';
        }
        if (! empty($errors)) {
            Session::flash('errors', $errors);
            Session::flash('old', $_POST);
            redirect('/register');
        }

        $userModel = new User;

        $create = $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        if ($create) {
            Session::flash('success', 'Usuario cadastrado com sucesso');
            redirect('/login');
        }

        Session::flash('error', 'Erro ao cadastrar usuario');
        redirect('/register');
    }
}
