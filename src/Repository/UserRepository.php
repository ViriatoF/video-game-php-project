<?php

declare(strict_types=1);

namespace App\Repository;

class UserRepository
{
    public function __construct(private \PDO $pdo) {}

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user ?: null; // fetch() retourne false si rien trouvé
    }

    public function create(array $data) : void
    {
        $stmt = $this->pdo->prepare('INSERT INTO users ( name, email, password) VALUES (:name, :email, :password)');
        $stmt->execute($data);
    }
}