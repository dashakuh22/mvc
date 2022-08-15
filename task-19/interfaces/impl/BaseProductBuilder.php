<?php

namespace App\interfaces\impl;

use App\interfaces\ProductBuilder;
use App\products\BaseProduct;

abstract class BaseProductBuilder implements ProductBuilder
{

    protected string $name;

    protected string $manufacturer;

    protected float $cost;

    protected string $releaseDate;

    public function __construct()
    {
    }

    public function setName(string $name): BaseProductBuilder
    {
        $this->name = $name;

        return $this;
    }

    public function setManufacturer(string $manufacturer): BaseProductBuilder
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function setCost(float $cost): BaseProductBuilder
    {
        $this->cost = $cost;

        return $this;
    }

    public function setReleaseDate(string $releaseDate): BaseProductBuilder
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function assign(BaseProduct $product): void
    {
        if (isset($this->name) && isset($this->manufacturer) && isset($this->releaseDate) && isset($this->cost)) {
            $product->setName($this->name);
            $product->setManufacturer($this->manufacturer);
            $product->setReleaseDate($this->releaseDate);
            $product->setCost($this->cost);
        } else {
            echo 'Name, manufacturer, cost and release date must be set for the product.';
            die();
        }
    }

    abstract public function getProduct(): BaseProduct;

}