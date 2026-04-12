<?php

declare(strict_types=1);

session_start();

require __DIR__.'/../vendor/autoload.php';

require __DIR__.'/../config/database.php';

use App\Controller\AuthController;
use App\Controller\GameController;

$pdo = getConnection();
$controller = new GameController($pdo);
$authController = new AuthController($pdo);

$page = $_GET['page'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

match ($page.'/'.$action) {
    'auth/login' => $authController->login(),
    'auth/register' => $authController->register(),

    'games/list' => $controller->list(),
    'games/show' => $controller->show((int) ($_GET['id'] ?? 0)),
    'games/create' => $controller->create(),
    'games/delete' => $controller->delete((int) ($_GET['id'] ?? 0)),
    default => http_response_code(404) && print ('Page non trouvée'),
};