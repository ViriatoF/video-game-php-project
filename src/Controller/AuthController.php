<?php

declare(strict_types=1);

namespace App\Controller;

use App\Middleware\CsrfMid;
use App\Repository\UserRepository;

class AuthController
{
    private UserRepository $userRepository;

    public function __construct(\PDO $pdo)
    {
        $this->userRepository = new UserRepository($pdo);
    }

    public function register(): void
    {
        if ('GET' === $_SERVER['REQUEST_METHOD']) {
            require __DIR__.'/../../views/auth/register.php';

            return;
        }

        $csrf = new CsrfMid();
        $csrf->CheckCsrf();

        // Validation
        $errors = [];
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ('' === $name) {
            $errors['name'] = 'Le nom est requis';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email invalide';
        }
        if (mb_strlen($password) < 8) {
            $errors['password'] = 'Minimum 8 caractères';
        }
        if (empty($errors) && $this->userRepository->findByEmail($email)) {
            $errors['email'] = 'Cet email est déjà utilisé';
        }

        // S'il y a des erreurs, réafficher le formulaire (sticky form)
        if (!empty($errors)) {
            $old = ['name' => $name, 'email' => $email];

            require __DIR__.'/../../views/auth/register.php';

            return;
        }

        // Tout est bon : créer l'utilisateur
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->userRepository->create([
            'name' => $name, 'email' => $email, 'password' => $hash,
        ]);

        $_SESSION['flash'] = 'Inscription réussie ! Connectez-vous.';
        header('Location: index.php?page=auth&action=login');

        $_SESSION['flash'] = 'Inscription réussie !';

        exit;
    }

    public function login(): void
    {
        if ('GET' === $_SERVER['REQUEST_METHOD']) {
            require __DIR__.'/../../views/auth/login.php';

            return;
        }

        $csrf = new CsrfMid();
        $csrf->CheckCsrf();

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $user = $this->userRepository->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            $error = 'Email ou mot de passe incorrect';
            $old = ['email' => $email];

            require __DIR__.'/../../views/auth/login.php';

            return;
        }
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: index.php?page=games&action=list');

        if (!$user || !password_verify($password, $user['password'])) {
            $error = 'Email ou mot de passe incorrect';
        }

        exit;
    }

    public function logout(): void
    {
        $_SESSION = []; // Vider les données

        // Supprimer le cookie de session
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 3600,
                $p['path'],
                $p['domain'],
                $p['secure'],
                $p['httponly']
            );
        }

        session_destroy(); // Détruire la session
        header('Location: index.php?page=auth&action=login');

        exit;
    }
}
