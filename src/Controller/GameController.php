<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\GameRepository;

class GameController
{
    private GameRepository $repository;

    public function __construct(\PDO $pdo)
    {
        $this->repository = new GameRepository($pdo);
    }

    public function list(): void
    {
        $games = $this->repository->findAll();

        require __DIR__.'/../../views/games/list.php';
    }

    public function create(): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->repository->save($_POST);
        header('Location: index.php?page=games');
        exit;
    }
    require __DIR__ . '/../../views/games/create.php';
}
}
