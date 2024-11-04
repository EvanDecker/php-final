<?php
namespace App\Database;

use PDO;
use PDOException;

class Database
{
    public static function connectToDB()
    {
        $dbname = "modules";
        $username = "root";
        $password = "secret";
        try {
            //TODO: figure out and fix having to change `host.docker.internal` to `localhost` when running the tests ????
            //pretty sure it's an issue regarding the docker network / not being able to find the docker container from the test
            $connection = new PDO("mysql:host=mysql:3306;dbname=$dbname", $username, $password);
            return $connection;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}