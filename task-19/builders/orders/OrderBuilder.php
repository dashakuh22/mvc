<?php

namespace App\builders\orders;

use App\interfaces\impl\BaseOrderBuilder;
use App\orders\BaseOrder;

class OrderBuilder extends BaseOrderBuilder
{

    public function __construct()
    {
    }

    public function assign(BaseOrder $order): void
    {
        parent::assign($order);
    }

    public function getOrder(): BaseOrder
    {
        $order = new BaseOrder();
        $this->assign($order);

        return $order;
    }

}