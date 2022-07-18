<?php

class UserModel
{

    public static function getUserById($userId)
    {
        $userId = intval($userId);

        if ($userId) {
            $db = DB::getConnection();

            $query = "SELECT name, gender, status, email FROM mvcdb WHERE id=".$userId;
            $result = $db->query($query);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    public static function getUserList()
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

    public static function addUser($userName, $userGender, $userStatus, $userEmail)
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

    public static function editUserById($userId, $userName, $userGender, $userStatus, $userEmail)
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

    public static function deleteUserById($userId)
    {
        $userId = intval($userId);

        if ($userId) {

            $db = DB::getConnection();

            $query = "DELETE FROM mvcdb WHERE id=:id";
            $result = $db->prepare($query);

            $result->bindParam(':id', $userId, PDO::PARAM_INT);

            return $result->execute();
        }
    }

}