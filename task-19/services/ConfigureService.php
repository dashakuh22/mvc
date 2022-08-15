<?php

namespace App\services;

class ConfigureService extends BaseService
{
    public function __toString(): string
    {
        return 'configureService [' .
            'COST = ' . $this->getCost() . ', ' .
            'DEADLINE = ' . $this->getDeadline() . ']';
    }
}