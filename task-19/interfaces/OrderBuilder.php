<?php

namespace App\interfaces;

use App\orders\BaseOrder;
use App\products\BaseProduct;

interface OrderBuilder
{

    public function setProduct(BaseProduct $product): OrderBuilder;

    public function setServices(array $services): OrderBuilder;

    public function assign(BaseOrder $order): void;

    public function getOrder(): BaseOrder;

}