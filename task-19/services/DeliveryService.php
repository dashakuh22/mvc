<?php

namespace App\services;

class DeliveryService extends BaseService
{
    public function __toString(): string
    {
        return 'deliveryService [' .
            'COST = ' . $this->getCost() . ', ' .
            'DEADLINE = ' . $this->getDeadline() . ']';
    }
}