<?php
namespace App\Models;
use PDO;
use PDOException;

class Book {
    private function connectToDB() {
        $dbname = "modules";
        $username = "modules";
        $password = "secret";
        try {
            $connection = new PDO( "mysql:host=mysql:3306;dbname=$dbname", $username, $password );
        } catch (PDOException $e) {
            $this->addError($e);
            echo $e;
        }
        return $connection;
    }

    public static function find($id) {
        $dbname = "modules";
        $username = "modules";
        $password = "secret";
        try {
            $connection = new PDO( "mysql:host=mysql:3306;dbname=$dbname", $username, $password );
        } catch (PDOException $e) {
            echo $e;
        }

        $query = "SELECT * FROM books WHERE id = '$id';";
        $res = $connection->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS)[0];
    }

    public static function findAll() {
        $dbname = "modules";
        $username = "modules";
        $password = "secret";
        try {
            $connection = new PDO( "mysql:host=mysql:3306;dbname=$dbname", $username, $password );
        } catch (PDOException $e) {
            echo $e;
        }

        $query = "SELECT * FROM books;";
        $res = $connection->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS);
    }

    public function save($book, $update = false) {
        if ($this->validate($book) === false) {
            return false;
        }
        if($update === true) {
          $dbBook = $this->find($book->id);
          if (!$dbBook) {
            $this->addError('A book with that id does not exist.');
            return false;
          } elseif ($book->id) {
            $query = "UPDATE books SET title='$book->title', author='$book->author', pages='$book->pages' WHERE id='$book->id';";
            $res = $this->connectToDB()->query($query);
            return $res ? true : false;
          }
        } else {
            if($this->findByTitle($book->title)) {
                $this->addError('A book with this title already exists, did you mean to update instead?');
                return false;
            }
            $query = "INSERT INTO books (title, author, pages) VALUES ('$book->title', '$book->author', '$book->pages');";
            $res = $this->connectToDB()->query($query);
            return $res ? true : false;
        }
    }

    public function destroy($id) {
        $query = "DELETE FROM books WHERE id = '$id';";
        $res = $this->connectToDB()->query($query);
        if ($res->rowCount() > 0) {
          return true;
        } else {
          $this->addError('Pleaes provide a valid book ID.');
          return false;
        }
    }

    private function validate($book) {
        if($book && $book->title && $book->author && $book->pages) {
            return true;
        } else {
            if(!$book->title) {
                $this->addError('Book must have a title. ');
            }
            if(!$book->author) {
                $this->addError('Book must have an author. ');
            }
            if(!$book->pages) {
                $this->addError('Book must have pages. ');
            }
            return false;
        }
    }

    public function errors() {
        return $this->errs;
    }

    public function addError($err) {
        if (in_array($err, $this->errs)) return;
        $this->errs[] = $err;
    }

    public function findByTitle($title) {
        $query = "SELECT * FROM books WHERE title = '$title';";
        $res = $this->connectToDB()->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS);
    }
    
    private $errs = [];
}
