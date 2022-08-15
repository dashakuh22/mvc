<?php

namespace App;

use App\builders\orders\OrderBuilder;
use App\builders\products\FridgeBuilder;
use App\builders\products\TVBuilder;
use App\builders\services\DeliveryBuilder;
use App\builders\services\WarrantyBuilder;

$tv = (new TVBuilder())
    ->setCost(100.99)
    ->setManufacturer('SAMSUNG')
    ->setReleaseDate('02.01.2021')
    ->setName('SAMSUNG AMS-332')
    ->setWifiSupport(true)
    ->getProduct();
echo $tv;
echo '<br />';

$delivery = (new DeliveryBuilder())
    ->setCost(40)
    ->setDeadline('16.08.2022')
    ->getService();
echo $delivery;
echo '<br />';

$warranty = (new WarrantyBuilder())
    ->setCost(60)
    ->setDeadline('19.08.2022')
    ->getService();
echo $warranty;
echo '<br />';

$order = (new OrderBuilder())
    ->setProduct($tv)
    ->setServices([$warranty, $delivery])
    ->getOrder();
echo $order;
echo '<br />';

$fridge = (new FridgeBuilder())
    ->setCost(120.99)
    ->setManufacturer('LG')
    ->setReleaseDate('22.01.2021')
    //->setName('LG WS-666')
    ->getProduct();
echo $fridge;