<?php

namespace App\interfaces;

use App\products\BaseProduct;

interface ProductBuilder
{

    public function setName(string $name): ProductBuilder;

    public function setManufacturer(string $manufacturer): ProductBuilder;

    public function setCost(float $cost): ProductBuilder;

    public function setReleaseDate(string $releaseDate): ProductBuilder;

    public function assign(BaseProduct $product): void;

    public function getProduct(): BaseProduct;

}