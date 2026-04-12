<?php

namespace App\Middleware;

class CsrfMid
{
    public function CheckCsrf(): void
    {
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
            http_response_code(403);

            exit('Token CSRF invalide');
        }
    }
}
