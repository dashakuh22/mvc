<?php

use App\controllers\TwigController;
use App\models\DashboardModel;

class DashboardController
{

    public TwigController $twig;

    public function __construct()
    {
        $this->twig = new TwigController();
    }

    public function actionIndex()
    {
        $this->twig->index(
            DashboardModel::getAveragePriceForAllTime(),
            DashboardModel::getAveragePriceToday(),
            DashboardModel::getUnsoldCarsModels(),
            DashboardModel::getUnsoldCars(),
            DashboardModel::getCarsSoldLastYear()
        );
    }

    public function actionError()
    {
        $this->twig->error();
    }

}