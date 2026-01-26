<?php

require __DIR__.'/../vendor/autoload.php';

// Load Environment Variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->safeLoad();

require __DIR__.'/../Core/functions.php';

use App\Models\Contact;
use App\Models\User;
use Core\Database;
use Core\Encryption;

try {
    echo "🌱 Iniciando Seeder...\n";
    $db = Database::getInstance()->getConnection();

    // Limpar tabelas
    $db->exec('DELETE FROM contacts');
    $db->exec('DELETE FROM users');
    $db->exec("DELETE FROM sqlite_sequence WHERE name='contacts' OR name='users'"); // Reset IDs

    echo "🧹 Banco limpo.\n";

    // Criar Usuário Padrão
    $user = new User;
    $user->create([
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => password_hash('password', PASSWORD_DEFAULT),
    ]);
    echo "👤 Usuário criado: admin@admin.com / password\n";

    // Criar Contatos Fictícios
    $contactModel = new Contact;

    $fakerNames = ['Ana Silva', 'Bruno Souza', 'Carlos Oliveira', 'Daniela Lima', 'Eduardo Santos'];
    $fakerEmails = ['ana@gmail.com', 'bruno@hotmail.com', 'carlos@yahoo.com', 'dani@outlook.com', 'edu@uol.com.br'];

    foreach ($fakerNames as $index => $name) {
        $contactModel->create([
            'name' => $name,
            'email' => Encryption::encrypt($fakerEmails[$index]),
            'phone' => Encryption::encrypt('(11) 99999-'.rand(1000, 9999)),
            'image_path' => 'default.png',
        ]);
    }

    echo "📞 5 Contatos criados com sucesso.\n";
    echo "🎉 Seeder finalizado!\n";

} catch (Exception $e) {
    echo '❌ Erro no Seeder: '.$e->getMessage()."\n";
    exit(1);
}
