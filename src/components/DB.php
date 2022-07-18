<?php

class DB {

    public static function getConnection() {
        try {

            $paramsPath = ROOT . '\config\db_params.php';
            $params = include $paramsPath;

            //$dsn = "mysql:host={$params['host']};dbname={$params['dbName']}"; // убираем перед
            //return new PDO($dsn, $params['userName'], $params['password']); // commit and push

        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
