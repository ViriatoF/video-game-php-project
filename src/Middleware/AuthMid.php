<?php

namespace App\Middleware;

class AuthMid
{
    public static function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=auth&action=login');

            exit;
        }
    }

    public static function currentUser(): ?array
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
        ];
    }
}
