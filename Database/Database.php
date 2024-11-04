<?php
namespace App\Database;

use PDO;
use PDOException;

class Database
{
    public static function connectToDB()
    {
        $dbname = "modules";
        $username = "modules";
        $password = "secret";
        try {
            // switch `mysql` to `localhost` in the dsn of the PDO to test
            $connection = new PDO("mysql:host=localhost:3306;dbname=$dbname", $username, $password);
            return $connection;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}