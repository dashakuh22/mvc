<?php

namespace App\services;

class WarrantyService extends BaseService
{
    public function __toString(): string
    {
        return 'warrantyService [' .
            'COST = ' . $this->getCost() . ', ' .
            'DEADLINE = ' . $this->getDeadline() . ']';
    }
}