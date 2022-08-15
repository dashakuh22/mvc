<?php

namespace App\builders\products;

use App\interfaces\impl\BaseProductBuilder;
use App\products\BaseProduct;
use App\products\TVProduct;

class TVBuilder extends BaseProductBuilder
{

    private bool|string $wifiSupport;

    public function __construct()
    {
        $this->wifiSupport = 'undefined';
    }

    public function setWifiSupport(bool $wifiSupport): TVBuilder
    {
        $this->wifiSupport = $wifiSupport;

        return $this;
    }

    public function assign(BaseProduct $product): void
    {
        parent::assign($product);
        $product->setWifiSupport($this->wifiSupport);
    }

    public function getProduct(): TVProduct
    {
        $product = new TVProduct();
        $this->assign($product);

        return $product;
    }

}