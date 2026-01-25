<?php

require __DIR__.'/../vendor/autoload.php';

use Core\Database;

try {
    echo "🔄️ Iniciando migracoes...\n";
    $db = Database::getInstance()->getConnection();

    $migrations = glob(__DIR__.'/migrations/*.php');
    foreach ($migrations as $file) {
        $migration = require $file;
        $filename = basename($file);
        echo "Runing {$filename}... \n";
        if (isset($migration['up'])) {
            $db->exec($migration['up']);
            echo "✅ {$filename} executada com sucesso.\n";
        }
    }
    echo "🎉 Todas as migrações foram concluídas!\n";

} catch (Exception $e) {
    echo '❌ Erro na migração: '.$e->getMessage()."\n";
    exit(1);
}
