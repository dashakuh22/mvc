<?php

namespace App\products;

class MobileProduct extends BaseProduct
{

    private int|string $countOfSIM;

    public function getCountOfSIM(): int|string
    {
        return $this->countOfSIM;
    }

    /**
     * @param int|string $countOfSIM
     */
    public function setCountOfSIM(int|string $countOfSIM): void
    {
        $this->countOfSIM = $countOfSIM;
    }

    public function __toString(): string
    {
        return 'mobileProduct [' .
            'NAME = ' . $this->getName() . ', ' .
            'COST = ' . $this->getCost() . ', ' .
            'MANUFACTURER = ' . $this->getManufacturer() . ', ' .
            'RELEASE DATE = ' . $this->getReleaseDate() . ', ' .
            'SIM = ' . $this->getCountOfSIM() . ']';
    }

}
