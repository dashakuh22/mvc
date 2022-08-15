<?php

namespace App\interfaces\impl;

use App\interfaces\OrderBuilder;
use App\orders\BaseOrder;
use App\products\BaseProduct;

abstract class BaseOrderBuilder implements OrderBuilder
{

    protected BaseProduct $product;

    protected array $services = [];

    public function __construct()
    {
    }

    public function setProduct(BaseProduct $product): BaseOrderBuilder
    {
        $this->product = $product;

        return $this;
    }

    public function setServices(array $services): BaseOrderBuilder
    {
        $this->services = $services;

        return $this;
    }

    public function assign(BaseOrder $order): void
    {
        if (isset($this->product)) {
            $order->setProduct($this->product);
            $order->setServices($this->services);
        } else {
            echo 'Product must be set to the order.';
            die();
        }
    }

    abstract public function getOrder(): BaseOrder;

}
