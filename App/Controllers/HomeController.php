<?php

namespace App\Controllers;

use App\Models\Contact;
use Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $contactModel = new Contact;
        $contacts = $contactModel->all();
        $search = $_GET['search'] ?? '';
        if (! empty($search)) {
            $contacts = array_filter($contacts, function ($contact) use ($search) {
                return stripos($contact['name'], $search) !== false ||
                       stripos($contact['email'], $search) !== false ||
                       stripos($contact['phone'], $search) !== false;
            });
        }
        usort($contacts, fn ($a, $b) => strcasecmp($a['name'], $b['name']));
        $groupedContacts = [];
        foreach ($contacts as $contact) {
            $initial = strtoupper(mb_substr($contact['name'], 0, 1));
            $groupedContacts[$initial][] = $contact;
        }
        $letra = $_GET['letra'] ?? '#';
        $this->view('home', [
            'letraSelecionada' => $letra,
            'contacts' => $groupedContacts,
        ]);
    }
}
