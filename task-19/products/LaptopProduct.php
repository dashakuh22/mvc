<?php

namespace App\products;

class LaptopProduct extends BaseProduct
{

    private int|string $memory;

    public function getMemory(): int|string
    {
        return $this->memory;
    }

    /**
     * @param int|string $memory
     */
    public function setMemory(int|string $memory): void
    {
        $this->memory = $memory;
    }

    public function __toString(): string
    {
        return 'laptopProduct [' .
            'NAME = ' . $this->getName() . ', ' .
            'COST = ' . $this->getCost() . ', ' .
            'MANUFACTURER = ' . $this->getManufacturer() . ', ' .
            'RELEASE DATE = ' . $this->getReleaseDate() . ', ' .
            'MEMORY = ' . $this->getMemory() . 'GB]';
    }

}