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
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $this->repository->save($_POST);
            header('Location: index.php?page=games');

            exit;
        }

        require __DIR__.'/../../views/games/create.php';
    }

    public function show(int $id): void
    {
        $game = $this->repository->find($id);

        if (!$game) {
            http_response_code(404);
            echo 'Jeu non trouvé';

            return;
        }

        require __DIR__.'/../../views/games/show.php';
    }
}
