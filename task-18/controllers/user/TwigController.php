<?php

namespace App\controllers\user;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\controllers\UserController;

class TwigController
{

    public Environment $twig;
    public FilesystemLoader $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('views/user');
        $this->twig = new Environment($this->loader, [
            'cache' => false
        ]);
    }

    public function getAuthentication(): void
    {
        $checkValue = $this->getCheckValue();

        echo $this->twig->render('authentication.html.twig', [
            'check_value' => $checkValue,
        ]);
    }

    public function getRegistration(): void
    {
        $rand = $this->getCheckValue();

        echo $this->twig->render('registration.html.twig', [
            'check_value' => $rand,
            'password_info' => UserController::PASSWORD_INFO
        ]);
    }

    public function getAuthenticationResult(bool $isAuthenticated, string $user): void
    {
        $checkValue = $this->getCheckValue();

        echo $this->twig->render('greeting.html.twig', [
            'check_value' => $checkValue,
            'icon' => $isAuthenticated ? 'done' : 'close',
            'result' => $isAuthenticated ? 'success' : 'error',
            'notification' => $isAuthenticated ? "Welcome back, $user" : 'Login is incorrect.'
        ]);
    }

    public function getRegistrationResult(bool $isRegistered, array $errors, string $email,
                                          string $firstName, string $lastName): void
    {
        $rand = $this->getCheckValue();

        echo $this->twig->render('registration.html.twig', [

            'check_value' => $rand,

            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,

            'showResult' => 'fade in',
            'notification' => $errors,
            'icon' => $isRegistered ? 'done' : 'close',
            'result' => $isRegistered ? 'success' : 'error',
            'password_info' => UserController::PASSWORD_INFO,
        ]);
    }

    public function getFail(array $error): void
    {
        echo $this->twig->render('registration.html.twig', [
            'showResult' => 'fade in',
            'notification' => $error,
            'icon' => 'close',
            'result' => 'error',
            'password_info' => UserController::PASSWORD_INFO,
        ]);
    }

    private function getCheckValue(): int
    {
        $rand = rand();
        $_SESSION['check_value'] = $rand;

        return $rand;
    }

}