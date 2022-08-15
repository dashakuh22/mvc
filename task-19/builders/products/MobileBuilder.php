<?php

namespace App\builders\products;

use App\interfaces\impl\BaseProductBuilder;
use App\products\BaseProduct;
use App\products\MobileProduct;

class MobileBuilder extends BaseProductBuilder
{

    protected int|string $countOfSIM;

    public function __construct()
    {
        $this->countOfSIM = 'undefined';
    }

    public function setCountOfSIM(int $countOfSIM): MobileBuilder
    {
        $this->countOfSIM = $countOfSIM;

        return $this;
    }

    public function assign(BaseProduct $product): void
    {
        parent::assign($product);
        $product->setCountOfSIM($this->countOfSIM);
    }

    public function getProduct(): MobileProduct
    {
        $product = new MobileProduct();
        $this->assign($product);

        return $product;
    }

}