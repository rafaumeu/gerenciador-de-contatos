<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Models\User;
use Core\Controller;
use Core\Encryption;
use Core\Request;
use Core\Session;

class ContactController extends Controller
{
    public function index(): void
    {
        $contactModel = new Contact;
        $contacts = $contactModel->all();
        usort($contacts, fn ($a, $b) => strcasecmp($a['name'], $b['name']));
        $groupedContacts = [];
        foreach ($contacts as $contact) {
            $initial = strtoupper(mb_substr($contact['name'], 0, 1));
            $groupedContacts[$initial] = $contact;
        }
        $this->view('contatos', [
            'titulo' => 'Contatos',
            'contacts' => $groupedContacts,
        ]);
    }

    public function store(): void
    {
        $data = Request::all();
        $imagePath = 'default.png';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = __DIR__.'/../../public/uploads';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $newName = uniqid().'.'.$ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir.'/'.$newName)) {
                $imagePath = 'uploads/'.$newName;
            }
        }
        $contact = new Contact;
        $contact->create([
            'name' => $data['name'],
            'email' => Encryption::encrypt($data['email']),
            'phone' => Encryption::encrypt($data['phone']),
            'image_path' => $imagePath,
        ]);

        redirect('/');
    }

    public function update(): void
    {
        $data = Request::all();
        $id = (int) $data['id'];
        $contact = new Contact;
        $updateData = [
            'name' => $data['name'],
            'email' => Encryption::encrypt($data['email']),
            'phone' => Encryption::encrypt($data['phone']),
        ];
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = __DIR__.'/../../public/uploads';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $newName = uniqid().'.'.$ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir.'/'.$newName)) {
                $imagePath = 'uploads/'.$newName;
                $updateData['image_path'] = $imagePath;
            }
        }
        $contact->update($id, $updateData);
        redirect('/');
    }

    public function destroy(): void
    {
        $data = Request::all();
        $id = (int) $data['id'];
        $contact = new Contact;
        $contact->delete($id);
        redirect('/');
    }

    public function decrypt(): void
    {
        $password = $_POST['password'] ?? '';
        $userSession = Session::get('user');
        if (! $userSession) {
            redirect('/login');
        }
        if (empty($password)) {
            flash('errors', ['password' => 'A senha é obrigatória!']);
            redirect('/');
        }
        $userModel = new User;
        $user = $userModel->findByEmail($userSession['email']);
        if ($user && password_verify($password, $user['password'])) {
            Session::put('unlock_data', true);
            flash('success', 'Senha correta! Dados liberados');
            redirect('/');
        }
        flash('errors', ['password' => 'Senha incorreta!']);
        redirect('/');
    }

    public function lock(): void
    {
        Session::forget('unlock_data');
        flash('success', 'Dados bloqueados com segurança!');
        redirect('/');
    }
}
