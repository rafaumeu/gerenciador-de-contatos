<?php

namespace App\Controllers;

use App\Models\Contact;
use Core\Controller;
use Core\Request;

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
            'email' => $data['email'],
            'phone' => $data['phone'],
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
            'email' => $data['email'],
            'phone' => $data['phone'],
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
}
