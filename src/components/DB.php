<?php

namespace App\Components;

class DB {

    public static string $dbName;

    public static function getConnection(): PDO
    {
        try {
            $paramsPath = file_build_path(ROOT, 'config', 'configDB.php');
            $params = include $paramsPath;

            self::$dbName = $params['dbTableName'];
            $dsn = "mysql:host={$params['host']};dbname={$params['dbName']}";

            return new PDO($dsn, $params['userName'], $params['password']);

        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}