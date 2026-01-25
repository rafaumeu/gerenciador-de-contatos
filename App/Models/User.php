<?php

declare(strict_types=1);

namespace App\Models;

use Core\Model;
use PDO;

class User extends Model
{
    protected string $table = 'users';

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }
}
