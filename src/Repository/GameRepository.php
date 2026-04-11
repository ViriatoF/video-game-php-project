<?php

declare(strict_types=1);

namespace App\Repository;

class GameRepository implements RepositoryInterface
{
    public function __construct(private \PDO $pdo) {}

    public function findAll(): array
    {
        $sql = 'SELECT * FROM games
                ORDER BY games.release_date DESC';

        return $this->pdo->query($sql)->fetchAll();
    }

    public function find(int $id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM games WHERE id= :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO games ( title, genre, release_date) VALUES (:title, :genre,:release_date)');
        $stmt->execute($data);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE games SET title = :title, genre = :genre, release_date = :release_date WHERE id = :id'
        );
        $stmt->execute([...$data, 'id' => $id]);
    }

    public function delete(int $id): void
    {
        $this->pdo->prepare('DELETE FROM games WHERE id = :id')
            ->execute(['id' => $id])
        ;
    }
}
