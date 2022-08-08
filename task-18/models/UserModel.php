<?php

namespace App\models;

use App\components\DB;

class UserModel
{

    const HASH_ALGO = PASSWORD_BCRYPT;

    private mixed $configs;
    private string $curDir;

    public function __construct()
    {
        $this->configs = require_once file_build_path(ROOT, 'config', 'configDirectories.php');
        
        $this->curDir = getcwd();
        @mkdir(file_build_path($this->curDir, $this->configs['attacks_log']));
        date_default_timezone_set('Europe/Minsk');
    }

    public function getUserAttribute(string $attribute, string $email, string $password): string
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

    public function getUserByEmail(string $email): bool
    {
        $db = DB::getConnection();

        $query = 'SELECT id FROM ' . DB::$dbName . ' WHERE email=:email';

        $result = $db->prepare($query);
        $result->bindParam(':email', $email);
        $result->execute();

        return $result->rowCount() > 0;
    }

    public function addUser(string $email, string $firstName, string $lastName, string $password): bool
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

    public function getPasswordHash(string $password): string
    {
        return password_hash($password, self::HASH_ALGO);
    }

    public function updateLog(string $ip, string $email, int $start, int $end): void
    {
        $logFileName = file_build_path($this->curDir, $this->configs['attacks_log'], self::getLogName());
        $start = date('d-m-Y H:i:s', $start);
        $end = date('d-m-Y H:i:s', $end);

        $info = "
        IP-address: $ip
        email: $email
        start blocking: $start
        end blocking: $end
        *****************\n";

        file_put_contents($logFileName, $info, FILE_APPEND);
    }

    public static function getLogName(): string
    {
        return 'attack_' . date('dmY') . '.log';
    }

}