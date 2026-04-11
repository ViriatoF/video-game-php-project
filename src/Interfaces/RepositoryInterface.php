<?php

namespace App\Interface;

interface RepositoryInterface
{
    public function find(int $id): ?array;

    public function findAll(): array;

    public function create(array $data): int;

    public function delete(int $id): bool;
}
