<?php

namespace App\models;

use App\components\DB;
use PDO;

class DashboardModel
{

    private static array $queries = [
        'averagePriceForAllTime' => 'SELECT showroom_cars.price 
                                     FROM showroom_cars 
                                     WHERE showroom_cars.sold_status = TRUE',

        'averagePriceToday' => 'SELECT showroom_cars.price 
                                FROM showroom_cars 
                                WHERE showroom_cars.sold_status = TRUE 
                                AND DATE(showroom_cars.sale_date) = DATE(NOW())',

        'carsUnsoldModels' => 'SELECT vehicle_directory.model 
                               FROM vehicle_directory 
                               INNER JOIN showroom_cars ON vehicle_directory.id = showroom_cars.vehicle_id 
                               WHERE sold_status = FALSE',

        'carsSoldLastYear' => 'SELECT DATE(showroom_cars.sale_date) AS sold_date, 
                                      COUNT(showroom_cars.id) AS cars_count
                               FROM showroom_cars 
                               WHERE sold_status = TRUE 
                               AND YEAR(showroom_cars.sale_date) = YEAR(CURDATE() - INTERVAL 1 YEAR)
                               GROUP BY sold_date',

        'carsUnsold' => 'SELECT vehicle_directory.model, 
                                vehicle_directory.production, 
                                showroom_cars.color, 
                                showroom_cars.price 
                         FROM vehicle_directory 
                         INNER JOIN showroom_cars ON vehicle_directory.id = showroom_cars.vehicle_id 
                         WHERE sold_status = FALSE
                         ORDER BY vehicle_directory.production DESC, showroom_cars.price ASC',
    ];

    public static function getUnsoldCars(): array
    {
        return self::getUnsoldCarsData(self::$queries['carsUnsold']);
    }

    public static function getUnsoldCarsModels(): array
    {
        return self::getUnsoldCarsData(self::$queries['carsUnsoldModels'], false);
    }

    public static function getAveragePriceForAllTime(): string
    {
        return self::getAveragePrice(self::$queries['averagePriceForAllTime']);
    }

    public static function getAveragePriceToday(): string
    {
        return self::getAveragePrice(self::$queries['averagePriceToday']);
    }

    public static function getAveragePrice(string $query): string
    {
        $db = DB::getConnection();
        $result = $db->prepare($query);
        $result->execute();

        $average = 0.0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $average += $row['price'];
        }

        $average /= $result->rowCount();

        return $average;
    }

    public static function getUnsoldCarsData(string $query, bool $getFullData = true): array
    {
        $db = DB::getConnection();
        $result = $db->prepare($query);
        $result->execute();

        $models = [];
        for ($i = 0; $row = $result->fetch(PDO::FETCH_ASSOC); $i++) {
            $models[$i]['model'] = $row['model'];

            if ($getFullData) {
                $models[$i]['production'] = $row['production'];
                $models[$i]['price'] = $row['price'];
                $models[$i]['color'] = $row['color'];
            }

        }

        return $models;
    }

    public static function getCarsSoldLastYear(): array
    {
        $db = DB::getConnection();
        $result = $db->prepare(self::$queries['carsSoldLastYear']);
        $result->execute();

        $models = [];
        for ($i = 0; $row = $result->fetch(PDO::FETCH_ASSOC); $i++) {
            $models[$i]['cars_count'] = $row['cars_count'];
            $models[$i]['sold_date'] = $row['sold_date'];
        }

        return $models;
    }

}