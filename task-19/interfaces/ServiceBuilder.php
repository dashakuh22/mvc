<?php

namespace App\interfaces;

use App\services\BaseService;

interface ServiceBuilder
{

    public function setCost(float $cost): ServiceBuilder;

    public function setDeadline(string $deadline): ServiceBuilder;

    public function assign(BaseService $service): void;

    public function getService(): BaseService;

}