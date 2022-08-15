<?php

namespace App\products;

class BaseProduct
{

    private float $cost;

    private string $name;

    private string $manufacturer;

    private string $releaseDate;

    public function __construct()
    {
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     */
    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function __toString(): string
    {
        return 'baseProduct [' .
            'NAME = ' . $this->getName() . ', ' .
            'COST = ' . $this->getCost() . ', ' .
            'MANUFACTURER = ' . $this->getManufacturer() . ', ' .
            'RELEASE DATE = ' . $this->getReleaseDate() . ']';
    }

}
