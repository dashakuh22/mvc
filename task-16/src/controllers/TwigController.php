<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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
        echo $this->twig->render('index.html.twig');
    }

    public function getResult(bool $isAuthenticated, string $user): void
    {
        echo $this->twig->render('greeting.html.twig', [
            'icon' => $isAuthenticated ? 'done' : 'close',
            'result' => $isAuthenticated ? 'success' : 'error',
            'notification' => $isAuthenticated ? "Welcome back, $user" : 'Login is incorrect.'
        ]);
    }

}