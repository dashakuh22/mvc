<?php

namespace App\components;

use Exception;
use PDO;

class DB
{

    public static string $dbName;

    public static function getConnection(string $table): PDO
    {
        try {

            $paramsPath = file_build_path(ROOT, 'config', 'configDB.php');
            $params = include $paramsPath;

            self::$dbName = $params[$table];
            $dsn = "mysql:host={$params['host']};dbname={$params['dbName']}";

            return new PDO($dsn, $params['userName'], $params['password']);

        } catch (Exception $e) {
            header('Location: /fail');
            die();
        }
    }
}