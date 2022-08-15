<?php

namespace App\builders\products;

use App\interfaces\impl\BaseProductBuilder;
use App\products\BaseProduct;
use App\products\FridgeProduct;

class FridgeBuilder extends BaseProductBuilder
{

    protected float|string $height;

    public function __construct()
    {
        $this->height = 'undefined';
    }

    public function setHeight(float $height): FridgeBuilder
    {
        $this->height = $height;

        return $this;
    }

    public function assign(BaseProduct $product): void
    {
        parent::assign($product);
        $product->setHeight($this->height);
    }

    public function getProduct(): FridgeProduct
    {
        $product = new FridgeProduct();
        $this->assign($product);

        return $product;
    }

}