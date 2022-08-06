<?php

namespace App\models;

use App\components\DB;

class UserModel
{

    const HASH_ALGO = PASSWORD_BCRYPT;

    public static function getUserAttribute(string $attribute, string $email, string $password): string
    {
        $db = DB::getConnection();

        $query = 'SELECT ' . $attribute . ' , password FROM ' . DB::$dbName . ' WHERE email=:email';

        $result = $db->prepare($query);
        $result->bindParam(':email', $email);
        $result->execute();
        $userInfo = $result->fetch(\PDO::FETCH_ASSOC);

        if ($userInfo) {
            if (password_verify($password, $userInfo['password'])) {
                return $userInfo[$attribute];
            }
        }

        return '';
    }

    public static function getUserByEmail(string $email): bool
    {
        $db = DB::getConnection();

        $query = 'SELECT id FROM ' . DB::$dbName . ' WHERE email=:email';

        $result = $db->prepare($query);
        $result->bindParam(':email', $email);
        $result->execute();

        return $result->rowCount() > 0;
    }

    public static function addUser(string $email, string $firstName, string $lastName, string $password): bool
    {
        $db = DB::getConnection();

        $query = 'INSERT IGNORE INTO ' . DB::$dbName . ' (email, first_name, last_name, password) 
                  VALUES (:email, :first_name, :last_name, :password)';

        $result = $db->prepare($query);
        $result->bindParam(':email', $email);
        $result->bindParam(':first_name', $firstName);
        $result->bindParam(':last_name', $lastName);
        $passwordHash = self::getPasswordHash($password);
        $result->bindParam(':password', $passwordHash);

        return $result->execute();
    }

    public static function getPasswordHash(string $password): string
    {
        return password_hash($password, self::HASH_ALGO);
    }

}