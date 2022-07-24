<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigController  {

    public Environment $twig;
    public FilesystemLoader $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('templates');
        $this->twig = new Environment($this->loader, [
            'cache' => false
        ]);
    }

    public function getAll(array $files): void
    {
        echo $this->twig->render('index.html.twig', [
            'files' => $files
        ]);
    }

    public function isUploaded(string $result): void
    {
        echo $this->twig->render('index.html.twig', [
            '{% extends "error.html.twig" %}'
        ]);
    }

}
