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
            echo $e;
        }
        return $connection;
    }

    public function find($id) {
        $query = "SELECT * FROM books WHERE id = '$id';";
        $res = $this->connectToDB()->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS);
    }

    public function findAll() {
        $query = "SELECT * FROM books;";
        $res = $this->connectToDB()->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS);
    }

    public function save($book, $update = false) {
        if ($this->validate($book) === false) {
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

    public function destroy($id) {
        $query = "DELETE FROM books WHERE title = '$id';";
        $res = $this->connectToDB()->query($query);
        return $res ? true : false;
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
    private function addError($err) {
        $this->errs[] = $err;
    }
    private $errs = [];
}
