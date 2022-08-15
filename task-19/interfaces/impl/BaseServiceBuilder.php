<?php

namespace App\interfaces\impl;

use App\interfaces\ServiceBuilder;
use App\services\BaseService;

abstract class BaseServiceBuilder implements ServiceBuilder
{

    protected float $cost;

    protected string $deadline;

    public function __construct()
    {
    }

    public function setCost(float $cost): BaseServiceBuilder
    {
        $this->cost = $cost;

        return $this;
    }

    public function setDeadline(string $deadline): BaseServiceBuilder
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function assign(BaseService $service): void
    {
        if (isset($this->cost) && isset($this->deadline)) {
            $service->setCost($this->cost);
            $service->setDeadline($this->deadline);
        } else {
            echo 'Cost and deadline must be set for the service.';
            die();
        }
    }

    abstract public function getService(): BaseService;

}