<?php
namespace Models;
use PDO;
use PDOException;

class Book {

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

  // CRUD books by interacting w/DB
  public function find($title) {
    $query = "SELECT * FROM books WHERE title = '$title';";
    $res = $this->connectToDB()->query($query);
    return $res->fetchAll(PDO::FETCH_CLASS);
  }

  public function findAll() {
    $query = "SELECT * FROM books;";
    $res = $this->connectToDB()->query($query);
    return $res->fetchAll(PDO::FETCH_CLASS);
  }

  function save($book, $update = false) {
    if ($this->validate($book) === false) {
      echo "Book is missing one or more fields.";
      return false;
    }
    if($update === true) {
      $query = "UPDATE books SET title='$book->title', author='$book->author', pages='$book->pages' WHERE title='$book->title';";
      $res = $this->connectToDB()->query($query);
      return $res ? true : false;
    } else {
      if($this->find($book->title)) {
        echo 'A book with this title already exists, did you mean to update instead?';
        return false;
      }
      $query = "INSERT INTO books (title, author, pages) VALUES ('$book->title', '$book->author', '$book->pages');";
      $res = $this->connectToDB()->query($query);
      return $res ? true : false;
    }
  }

  function destroy($title) {
    $query = "DELETE FROM books WHERE title = '$title';";
    $res = $this->connectToDB()->query($query);
    return $res ? true : false;
  }

  function validate($book) {
    if($book && $book->title && $book->author && $book->pages) {
      return true;
    } else {
      if(!$book->title) {
        $this->addError('Book must have a title.');
      }
      if(!$book->author) {
        $this->addError('Book must have an author.');
      }
      if(!$book->pages) {
        $this->addError('Book must have pages.');
      }
      return false;
    }
  }

  function errors() {
    return $this->errs;
  }
  function addError($err) {
    $this->errs[] = $err;
  }
  private $errs = [];
}

class BookType {
  function __construct($title, $author, $pages) {
    $this->title = $title;
    $this->author = $author;
    $this->pages = $pages;
  }
  public $title;
  public $author;
  public $pages;
}
