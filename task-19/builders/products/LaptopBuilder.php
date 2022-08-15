<?php

namespace App\builders\products;

use App\interfaces\impl\BaseProductBuilder;
use App\products\BaseProduct;
use App\products\LaptopProduct;

class LaptopBuilder extends BaseProductBuilder
{

    protected int|string $memory;

    public function __construct()
    {
        $this->memory = 'undefined';
    }

    public function setMemory(int $memory): LaptopBuilder
    {
        $this->memory = $memory;

        return $this;
    }

    public function assign(BaseProduct $product): void
    {
        parent::assign($product);
        $product->setMemory($this->memory);
    }

    public function getProduct(): LaptopProduct
    {
        $product = new LaptopProduct();
        $this->assign($product);

        return $product;
    }

}