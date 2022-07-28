<?php

namespace App\Models;

use App\Components\DB;

class UserModel
{

    public static function getUser(string $userEmail, string $userName, string $userPassword): bool
    {
        $db = DB::getConnection();

        $query = "INSERT INTO " . DB::$dbName . " (email, name, password) 
                  VALUES (:email, :name, :password)";
        $result = $db->prepare($query);

        $result->bindParam(':email', $userEmail);
        $result->bindParam(':name', $userName);
        $result->bindParam(':password', $userPassword);

        return $result->execute();
    }

    public static function addUser(string $userEmail, string $userName, string $userPassword): bool
    {
        $db = DB::getConnection();

        $query = "INSERT INTO " . DB::$dbName . " (email, name, password) 
                  VALUES (:email, :name, :password)";
        $result = $db->prepare($query);

        $result->bindParam(':email', $userEmail);
        $result->bindParam(':name', $userName);
        $result->bindParam(':password', $userPassword);

        return $result->execute();
    }

}