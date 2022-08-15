<?php

namespace App\builders\services;

use App\interfaces\impl\BaseServiceBuilder;
use App\services\BaseService;
use App\services\InstallService;

class InstallBuilder extends BaseServiceBuilder
{

    public function __construct()
    {
    }

    public function assign(BaseService $service): void
    {
        parent::assign($service);
    }

    public function getService(): InstallService
    {
        $service = new InstallService();
        $this->assign($service);

        return $service;
    }
}