<?php
namespace App\Models;

use PDO;
use \App\Database\Database;

class Book
{
    private $errs = [];

    public static function find($id)
    {
        $connection = Database::connectToDB();
        $query = "SELECT * FROM books WHERE id = '$id';";
        $res = $connection->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS)[0];
    }

    public static function findAll()
    {
        $connection = Database::connectToDB();
        $query = "SELECT * FROM books;";
        $res = $connection->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS);
    }

    public function save($book, $update = false)
    {
        if ($this->validate($book) === false) {
            return false;
        }
        if ($update === true) {
            $dbBook = $this->find($book->id);
            if (!$dbBook) {
                $this->addError('A book with that id does not exist.');
                return false;
            } elseif ($book->id) {
                $query = "UPDATE books SET title='$book->title', author='$book->author', pages='$book->pages' WHERE id='$book->id';";
                $res = Database::connectToDB()->query($query);
                return $res ? true : false;
            }
        } else {
            if ($this->findByTitle($book->title)) {
                $this->addError('A book with this title already exists, did you mean to update instead?');
                return false;
            }
            $query = "INSERT INTO books (title, author, pages) VALUES ('$book->title', '$book->author', '$book->pages');";
            $res = Database::connectToDB()->query($query);
            return $res ? true : false;
        }
    }

    public function destroy($id)
    {
        $query = "DELETE FROM books WHERE id = '$id';";
        $res = Database::connectToDB()->query($query);
        if ($res->rowCount() > 0) {
            return true;
        } else {
            $this->addError('Please provide a valid book ID.');
            return false;
        }
    }

    public function validate($book)
    {
        $titleError = 'Book must have a title. ';
        $authorError = 'Book must have an author. ';
        $pagesError = 'Book must have pages. ';

        if (!$book || !property_exists($book, 'title') || !property_exists($book, 'author') || !property_exists($book, 'pages')) {
            if (!property_exists($book, 'title') && !$this->checkErrInArr($titleError)) {
                $this->addError($titleError);
            } elseif (property_exists($book, 'title') && in_array($titleError, $this->errs)) {
                $this->removeError($titleError);
            }
            if (!property_exists($book, 'author') && !$this->checkErrInArr($authorError)) {
                $this->addError($authorError);
            } elseif (property_exists($book, 'author') && in_array($authorError, $this->errs)) {
                $this->removeError($authorError);
            }
            if (!property_exists($book, 'pages') && !$this->checkErrInArr($pagesError)) {
                $this->addError($pagesError);
            } elseif (property_exists($book, 'pages') && in_array($pagesError, $this->errs)) {
                $this->removeError($pagesError);
            }
            return false;
        } else {
            $this->removeError($titleError);
            $this->removeError($authorError);
            $this->removeError($pagesError);
            return true;
        }
    }

    public function errors()
    {
        return $this->errs;
    }

    public function addError($err)
    {
        if (in_array($err, $this->errs))
            return;
        $this->errs[] = $err;
    }

    private function removeError($err)
    {
        $index = array_search($err, $this->errs);
        unset($this->errs[$index]);
    }

    private function checkErrInArr($err)
    {
        return array_search($err, $this->errs);
    }

    public function findByTitle($title)
    {
        $query = "SELECT * FROM books WHERE title = '$title';";
        $res = Database::connectToDB()->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS);
    }
}
