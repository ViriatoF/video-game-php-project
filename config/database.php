<?php

declare(strict_types=1);

function getConnection(): PDO
{
    static $pdo = null;

    if (null === $pdo) {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=video_games;charset=utf8mb4',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    return $pdo;
}