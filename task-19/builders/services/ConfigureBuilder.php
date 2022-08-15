<?php

namespace App\builders\services;

use App\interfaces\impl\BaseServiceBuilder;
use App\services\BaseService;
use App\services\ConfigureService;

class ConfigureBuilder extends BaseServiceBuilder
{

    public function __construct()
    {
    }

    public function assign(BaseService $service): void
    {
        parent::assign($service);
    }

    public function getService(): ConfigureService
    {
        $service = new ConfigureService();
        $this->assign($service);

        return $service;
    }
}