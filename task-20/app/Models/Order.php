<?php

namespace App\Models;

class Order
{

    public array $product;

    public array $services;

    public float $cost;

    public function __construct(array $product, array $services)
    {
        $this->product = $product;
        $this->services = $services;
        $this->setCost();
    }

    public function setCost(): void
    {
        $cost = $this->product['cost'];

        if (!empty($this->services)) {
            foreach ($this->services as $service) {
                $cost += $service['cost'];
            }
        }

        $this->cost = $cost;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

}
