<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function find(int $id): ?array;

    public function findByUser(int $id): array;

    public function create(array $data): int;

    public function delete(int $id): bool;
}
