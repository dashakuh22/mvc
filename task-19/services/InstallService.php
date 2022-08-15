<?php

namespace App\services;

class InstallService extends BaseService
{
    public function __toString(): string
    {
        return 'installService [' .
            'COST = ' . $this->getCost() . ', ' .
            'DEADLINE = ' . $this->getDeadline() . ']';
    }
}