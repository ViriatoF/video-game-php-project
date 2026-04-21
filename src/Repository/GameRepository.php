<?php

declare(strict_types=1);

namespace App\Repository;

use App\Interfaces\RepositoryInterface;

class GameRepository implements RepositoryInterface
{
    public function __construct(private \PDO $pdo) {}

    public function findByUser(int $id): array
    {
        $sql = $this->pdo->prepare('SELECT games.* FROM games
                JOIN user_games ON games.id = user_games.game_id 
                WHERE user_games.user_id = :user_id
                ORDER BY games.release_date DESC');

        $sql->execute(['user_id' => $id]);

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find(int $id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM games WHERE id= :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO games ( title, genre, release_date) VALUES (:title, :genre,:release_date)');
            $stmt->execute($data);

            return (int) $this->pdo->lastInsertId();
        } catch (\PDOException $error) {
            return 0;
        }
    }

    public function update(int $id, array $data): void
    {
        try {
            $stmt = $this->pdo->prepare(
                'UPDATE games SET title = :title, genre = :genre, release_date = :release_date WHERE id = :id'
            );
            $stmt->execute([...$data, 'id' => $id]);
        } catch (\PDOException $error) {
            return;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM games WHERE id = :id');
            $stmt->execute(['id' => $id]);

            return true;
        } catch (\PDOException $error) {
            return false;
        }
    }
}
