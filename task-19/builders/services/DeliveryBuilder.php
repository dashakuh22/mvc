<?php

namespace App\builders\services;

use App\interfaces\impl\BaseServiceBuilder;
use App\services\BaseService;
use App\services\DeliveryService;

class DeliveryBuilder extends BaseServiceBuilder
{

    public function __construct()
    {
    }

    public function assign(BaseService $service): void
    {
        parent::assign($service);
    }

    public function getService(): DeliveryService
    {
        $service = new DeliveryService();
        $this->assign($service);

        return $service;
    }
}