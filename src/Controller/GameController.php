<?php

declare(strict_types=1);

namespace App\Controller;

use App\Middleware\AuthMid;
use App\Middleware\CsrfMid;
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
        $id = $_SESSION['user_id'];
        $games = $this->repository->findByUser($id);

        require __DIR__.'/../../views/games/list.php';
    }

    public function create(): void
    {
        AuthMid::requireAuth();
        $errors = [];
        $old = [];
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $csrf = new CsrfMid();
            $csrf->CheckCsrf();

            $old = [
                'title' => trim($_POST['title'] ?? ''),
                'release_date' => $_POST['release_date'] ?? '',
                'genre' => trim($_POST['genre'] ?? ''),
            ];

            if ('' === $old['title']) {
                $errors['title'] = 'Le titre est requis';
            }
            if ('' === $old['release_date']) {
                $errors['release_date'] = "L'année est requise";
            }
            if ('' === $old['genre']) {
                $errors['genre'] = 'Le genre est requis';
            }

            if (empty($errors)) {
                $this->repository->create([
                    'title' => $old['title'],
                    'genre' => $old['genre'],
                    'release_date' =>  $old['release_year'],
                ]);

                header('Location: index.php?page=games&action=list');

                exit;
            }
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

    public function destroy(int $id): void
    {
        AuthMid::requireAuth();
        if ($this->repository->delete($id)) {
            $_SESSION['flash'] = 'Le jeu est bien supprimé.';
        } else {
            $_SESSION['error'] = 'Le jeu est bien supprimé.';
        }
        header('Location: index.php?page=games&action=list');

        exit;
    }
}
