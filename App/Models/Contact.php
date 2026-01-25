<?php

declare(strict_types=1);

namespace App\Models;

use Core\Model;

class Contact extends Model
{
    protected string $table = 'contacts';

    public function search(string $query): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE name LIKE :query OR email LIKE :query OR phone LIKE :query";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['query' => "%{$query}%"]);

        return $stmt->fetchAll();
    }
}
