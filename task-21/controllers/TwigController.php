<?php

namespace App\controllers;

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

    public function index
    (
        float $averageForAllTime,
        float $averageToday,
        array $unsoldCarsModels,
        array $unsoldCars,
        array $carsSoldLastYear
    ): void
    {
        echo $this->twig->render('index.html.twig', [
            'unsoldCars' => $unsoldCars,
            'carsSoldLastYear' => $carsSoldLastYear,
            'averageForAllTime' => $averageForAllTime,
            'averageToday' => $averageToday,
            'unsoldCarsModels' => $unsoldCarsModels,
        ]);
        exit();
    }

    public function error(): void
    {
        echo $this->twig->render('error.html.twig');
        exit();
    }

}
