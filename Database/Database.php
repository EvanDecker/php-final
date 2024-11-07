<?php
namespace App\Database;

use PDO;
use PDOException;

class Database
{
    /**
     * Forms a connection to the mysql database.
     * 
     * @return PDO The connection.
     */
    public static function connectToDB()
    {
        $dbname = "modules";
        $username = "modules";
        $password = "secret";
        try {
            $connection = new PDO("mysql:host=mysql:3306;dbname=$dbname", $username, $password);
            return $connection;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}