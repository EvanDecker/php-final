<?php
namespace Models;
use PDO;
use PDOException;



class Book {

  // function __construct($title, $author, $pages) {
  //   $this->title = $title;
  //   $this->author = $author;
  //   $this->pages = $pages;
  // }

  // public function getTitle(): string {
  //   return $this->title;
  // }

  // public function getAuthor() {
  //   return $this->author;
  // }

  // public function getPages() {
  //   return $this->pages;
  // }

  // private $title;
  // private $author;
  // private $pages;

  // CRUD books by interacting w/DB
  // find() and findAll() to fetch model records
  function find($title) {
    $query = "SELECT * FROM books WHERE title = '$title';";
    $res = connectToDB()->query($query);
    return $res->fetchAll(PDO::FETCH_CLASS);
  }

  function findAll() {
    $query = "SELECT * FROM books;";
    $res = connectToDB()->query($query);
    return $res->fetchAll(PDO::FETCH_CLASS);
  }

  // save() to insert or update a record into the db
    // attempt to validate the model before trying to save
      // if not validated, should return False
    // return True or False if successful

  // destroy() to delete the record from the db
  // validate to validate properties on the model (returns True or False as to if the model is valid)
    // should feed data to an errors() function that returns an array of errors (if any)
}

function connectToDB() {
  $servername = "modules";
  // TODO: change username back to modules and make it work
  $username = "root";
  $password = "secret";
  try {
    $connection = new PDO( "mysql:host=mysql:3306;dbname=$servername", $username, $password );
  } catch (PDOException $e) {
    echo $e;
  }
  return $connection;
}

// $res = $connection->query("SELECT * FROM books;");
// var_dump($res->fetchAll(PDO::FETCH_CLASS));