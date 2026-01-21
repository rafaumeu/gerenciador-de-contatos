<?php

require __DIR__.'/../vendor/autoload.php';

use Core\Database;

try {
    echo "🔄️ Iniciando migração...\n";
    $db = Database::getInstance()->getConnection();
    $sql = '
  CREATE TABLE IF NOT EXISTS contacts(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  ';
    $db->exec($sql);
    echo "✅ Tabela 'contacts' verificada/criada com sucesso";

} catch (Exception $e) {
    echo '❌ Erro na migração: '.$e->getMessage()."\n";
    exit(1);
}
