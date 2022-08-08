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

    public function getFileForm(array $files, array $notification, bool $isSuccess): void
    {
        $rand = $this->getCheckValue();

        echo $this->twig->render('index.html.twig', [
            'check_value' => $rand,

            'files' => $files,
            'notification' => $notification,
            'icon' => $isSuccess ? 'done' : 'close',
            'result' => $isSuccess ? 'success' : 'error',
            'showResult' => empty($notification) ? "fade" : "fade in"
        ]);
    }

    private function getCheckValue(): int
    {
        $rand = rand();
        $_SESSION['check_value'] = $rand;

        return $rand;
    }

}