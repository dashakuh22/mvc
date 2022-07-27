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

    public function getAll(array $files, string $result): void
    {
        echo $this->twig->render('index.html.twig', [
            'files' => $files,
            'result' => $result,
            'showResult' => $result === '' ? "fade" : "fade in",
            'styleResult' => $result === '' ? "display: none" : "display: block; padding-right: 17px;"
        ]);
    }

}
