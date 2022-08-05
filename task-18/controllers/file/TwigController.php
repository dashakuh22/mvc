<?php

namespace App\controllers\file;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\controllers\FileController;

class TwigController
{

    public Environment $twig;
    public FilesystemLoader $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('views/file');
        $this->twig = new Environment($this->loader, [
            'cache' => false
        ]);
    }

    public function getFiles(array $files, string $result): void
    {
        echo $this->twig->render('index.html.twig', [
            'files' => $files,
            'result' => $result,
            'showResult' => $result === '' ? "fade" : "fade in"
        ]);
    }

}