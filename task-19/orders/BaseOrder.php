<?php

namespace App\orders;

use App\products\BaseProduct;

class BaseOrder
{

    private BaseProduct $product;

    private array $services;

    public function __construct()
    {
    }

    /**
     * @return BaseProduct
     */
    public function getProduct(): BaseProduct
    {
        return $this->product;
    }

    /**
     * @param BaseProduct $product
     */
    public function setProduct(BaseProduct $product): void
    {
        $this->product = $product;
    }

    /**
     * @return array
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param array $services
     */
    public function setServices(array $services): void
    {
        $this->services = $services;
    }

    /**
     * @return float
     */
    public function getTotalCost(): float
    {
        $result = 0.0;

        $services = $this->getServices();
        foreach ($services as $service) {
            $result += $service->getCost();
        }

        $result += $this->getProduct()->getCost();

        return $result;
    }

    public function __toString(): string
    {
        $result = 'baseOrder [ ' . '<br>&emsp;' . $this->getProduct() . '<br>';

        $services = $this->getServices();
        foreach ($services as $service) {
            $result .= '&emsp;' . $service . '<br>';
        }

        $result .= '&emsp;total cost: ' . $this->getTotalCost() . '<br>';

        return $result . ']';
    }

}