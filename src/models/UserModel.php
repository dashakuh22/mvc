<?php

class UserModel
{

    public static function getUserById(int $userId): bool
    {
        $db = DB::getConnection();

        $query = "SELECT name, gender, status, email FROM mvcdb WHERE id=:id";
        $result = $db->prepare($query);

        $result->bindParam(':id', $userId, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getUserList(): array
    {
        $db = DB::getConnection();

        $query = "SELECT name, gender, status, email, id FROM mvcdb";
        $result = $db->query($query);

        $userList = array();

        for ($i = 0; $row = $result->fetch(); $i++) {
            $userList[$i]['name'] = $row['name'];
            $userList[$i]['gender'] = $row['gender'];
            $userList[$i]['status'] = $row['status'];
            $userList[$i]['email'] = $row['email'];
            $userList[$i]['id'] = $row['id'];
        }

        return $userList;
    }

    public static function addUser(string $userName, string $userGender, string $userStatus, string $userEmail): bool
    {
        $db = DB::getConnection();

        $query = "INSERT INTO mvcdb (name, gender, status, email) 
                  VALUES (:name, :gender, :status, :email)";
        $result = $db->prepare($query);

        $result->bindParam(':name', $userName, PDO::PARAM_STR);
        $result->bindParam(':gender', $userGender, PDO::PARAM_STR);
        $result->bindParam(':status', $userStatus, PDO::PARAM_STR);
        $result->bindParam(':email', $userEmail, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function editUserById(int $userId, string $userName, string $userGender, string $userStatus, string $userEmail): bool
    {
        $db = DB::getConnection();

        $query = "UPDATE mvcdb 
                  SET name = :name, gender = :gender, status = :status, email = :email  
                  WHERE id=:id";
        $result = $db->prepare($query);

        $result->bindParam(':name', $userName, PDO::PARAM_STR);
        $result->bindParam(':gender', $userGender, PDO::PARAM_STR);
        $result->bindParam(':status', $userStatus, PDO::PARAM_STR);
        $result->bindParam(':email', $userEmail, PDO::PARAM_STR);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function deleteUserById(int $userId): bool
    {
        $db = DB::getConnection();

        $query = "DELETE FROM mvcdb WHERE id=:id";
        $result = $db->prepare($query);

        $result->bindParam(':id', $userId, PDO::PARAM_INT);

        return $result->execute();
    }

}