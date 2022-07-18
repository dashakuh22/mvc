<?php

class DB {

    public static function getConnection() {
        try {
            $paramsPath = ROOT . '\config\db_params.php';
            $params = include $paramsPath;

            $dsn = "mysql:host={$params['host']};dbname={$params['dbName']}";
            $dbh = new PDO($dsn, $params['userName'], $params['password']);
//            $dbh = mysqli_connect($params['host'], $params['userName'], $params['password'], $params['dbName']);

            return $dbh;
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
