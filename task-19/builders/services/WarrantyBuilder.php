<?php

namespace App\builders\services;

use App\interfaces\impl\BaseServiceBuilder;
use App\services\BaseService;
use App\services\WarrantyService;

class
WarrantyBuilder extends BaseServiceBuilder
{

    public function __construct()
    {
    }

    public function assign(BaseService $service): void
    {
        parent::assign($service);
    }

    public function getService(): WarrantyService
    {
        $service = new WarrantyService();
        $this->assign($service);

        return $service;
    }
}