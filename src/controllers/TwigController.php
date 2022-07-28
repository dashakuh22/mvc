<?php

namespace App\Controllers;

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

    public function getForm(string $action): void
    {
        echo $this->twig->render($action . '.html.twig');
    }

}