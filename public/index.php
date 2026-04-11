<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

require __DIR__.'/../config/database.php';

use App\Controller\GameController;

$pdo = getConnection();
$controller = new GameController($pdo);

$page = $_GET['page'] ?? 'games';
$action = $_GET['action'] ?? 'list';

match ($page.'/'.$action) {
    'games/list' => $controller->list(),
    'games/show' => $controller->show((int) ($_GET['id'] ?? 0)),
    'games/create' => $controller->create(),
    'games/delete' => $controller->delete((int) ($_GET['id'] ?? 0)),
    default => http_response_code(404) && print ('Page non trouvée'),
};
