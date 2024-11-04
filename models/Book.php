<?php
namespace App\Models;

use PDO;
use \App\Database\Database;

class Book
{
    /** @type string[] An array of errors. */
    private $errs = [];

    /**
     * Find a book in the DB by id.
     * 
     * @param int $id The id of the book to find.
     * 
     * @return mixed The result as an array of objects.
     */
    public static function find($id)
    {
        $connection = Database::connectToDB();
        $query = "SELECT * FROM books WHERE id = '$id';";
        $res = $connection->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS)[0];
    }

    /**
     * Find all books in the DB.
     * 
     * @return array The results as an array of objects.
     */
    public static function findAll()
    {
        $connection = Database::connectToDB();
        $query = "SELECT * FROM books;";
        $res = $connection->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Inserts a new book into the DB.
     * 
     * @param mixed $book The book to be added to the DB.
     * @param bool $update Optional to indicate an update instead of an insert.
     * 
     * @return bool The success of the operation.
     */
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

    /**
     * Deletes a book from the DB.
     * 
     * @param int $id The id of the book to be deleted.
     * 
     * @return bool The success of the operation.
     */
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

    /**
     * Checks if a book is valid to be added to the DB.
     * 
     * Verifies that there is a title, author, and pages on the provided book.
     * Adds or removes errors as necessary.
     * 
     * @param mixed $book The book in question.
     * 
     * @return bool The success of the operation.
     */
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

    /**
     * Returns any errors.
     * 
     * @return string[] The array of errors.
     */
    public function errors()
    {
        return $this->errs;
    }

    /**
     * Adds an error to the error array.
     * 
     * @param string $err The error to be added.
     * 
     * @return void
     */
    public function addError($err)
    {
        if (in_array($err, $this->errs))
            return;
        $this->errs[] = $err;
    }

    /**
     * Removes an error from the error array.
     * 
     * @param string $err The error to be removed.
     * 
     * @return void
     */
    private function removeError($err)
    {
        $index = array_search($err, $this->errs);
        unset($this->errs[$index]);
    }

    /**
     * Determines if an error is already in the error array.
     * 
     * @param string $err The error to check.
     * 
     * @return bool|int|string Whether the error exists already or not.
     */
    private function checkErrInArr($err)
    {
        return array_search($err, $this->errs);
    }

    /**
     * Finds a book in the DB by title.
     * 
     * @param string $title The book to be found's title.
     * 
     * @return array The results as an array of objects.
     */
    public function findByTitle($title)
    {
        $query = "SELECT * FROM books WHERE title = '$title';";
        $res = Database::connectToDB()->query($query);
        return $res->fetchAll(PDO::FETCH_CLASS);
    }
}
