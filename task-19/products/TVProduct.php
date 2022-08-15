<?php

namespace App\products;

class TVProduct extends BaseProduct
{

    private bool|string $wifiSupport;

    public function isWifiSupport(): bool|string
    {
        return $this->wifiSupport;
    }

    /**
     * @param bool|string $wifiSupport
     */
    public function setWifiSupport(bool|string $wifiSupport): void
    {
        if (!is_string($wifiSupport)) {
            $this->wifiSupport = $wifiSupport ? 'available' : 'not available';
        } else {
            $this->wifiSupport = $wifiSupport;
        }
    }

    public function __toString(): string
    {
        return 'tvProduct [' .
            'NAME = ' . $this->getName() . ', ' .
            'COST = ' . $this->getCost() . ', ' .
            'MANUFACTURER = ' . $this->getManufacturer() . ', ' .
            'RELEASE DATE = ' . $this->getReleaseDate() . ', ' .
            'Wi-Fi = ' . $this->isWifiSupport() . ']';
    }

}
