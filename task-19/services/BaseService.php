<?php

namespace App\services;

class BaseService
{

    private float $cost;

    private string $deadline;

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
    public function getDeadline(): string
    {
        return $this->deadline;
    }

    /**
     * @param string $deadline
     */
    public function setDeadline(string $deadline): void
    {
        $this->deadline = $deadline;
    }

    public function __toString(): string
    {
        return 'baseService [' .
            'COST = ' . $this->getCost() . ', ' .
            'DEADLINE = ' . $this->getDeadline() . ']';
    }

}
