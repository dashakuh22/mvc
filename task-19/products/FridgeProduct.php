<?php

namespace App\products;

class FridgeProduct extends BaseProduct
{

    private float|string $height;

    /**
     * @return float
     */
    public function getHeight(): float|string
    {
        return $this->height;
    }

    /**
     * @param float|string $height
     */
    public function setHeight(float|string $height): void
    {
        $this->height = $height;
    }

    public function __toString(): string
    {
        return 'fridgeProduct [' .
            'NAME = ' . $this->getName() . ', ' .
            'COST = ' . $this->getCost() . ', ' .
            'MANUFACTURER = ' . $this->getManufacturer() . ', ' .
            'RELEASE DATE = ' . $this->getReleaseDate() . ', ' .
            'HEIGHT = ' . $this->getHeight() . ']';
    }

}