<?php

$servername = "modules";
// TODO: change username back to modules and make it work
$username = "root";
$password = "secret";

try {
  $connection = new PDO( 'mysql:host=mysql:3306;dbname=modules', $username, $password );
} catch (PDOException $e) {
  echo $e;
}
$res = $connection->query("SELECT * FROM books;");
var_dump($res->fetchAll(PDO::FETCH_CLASS));