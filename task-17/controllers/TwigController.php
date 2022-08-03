<?php

namespace App\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use UserController;

class TwigController
{

    public Environment $twig;
    public FilesystemLoader $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('views');
        $this->twig = new Environment($this->loader, [
            'cache' => false
        ]);
    }

    public function getIndex(): void
    {
        $rand = $this->revalidate_check_val();

        echo $this->twig->render('index.html.twig', [
            'check_value' => $rand,
            'password_info' => UserController::PASSWORD_INFO
        ]);
    }

    public function getResult(bool $isRegistered, array $errors, string $email, string $firstName, string $lastName): void
    {
        $rand = $this->revalidate_check_val();

        echo $this->twig->render('index.html.twig', [

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

    private function revalidate_check_val(): int
    {
        $rand = rand();
        $_SESSION['check_value'] = $rand;

        return $rand;
    }

}
