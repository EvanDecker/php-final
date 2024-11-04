<?php
namespace App\Tests;

use stdClass;
use \App\Models\Book;

class BookTest extends \PHPUnit\Framework\TestCase
{

    public function testValidate()
    {
        $faker = \Faker\Factory::create();
        $model = new Book;

        $book = new stdClass();
        $this->assertFalse($model->validate($book));
        $this->assertContains('Book must have a title. ', $model->errors());
        $this->assertContains('Book must have an author. ', $model->errors());
        $this->assertContains('Book must have pages. ', $model->errors());

        $book->title = $faker->title();
        $model->validate($book);
        $this->assertNotContains('Book must have a title. ', $model->errors());

        $book->author = $faker->name();
        $model->validate($book);
        $this->assertNotContains('Book must have an author. ', $model->errors());

        $book->pages = $faker->numberBetween(1, 1000);
        $model->validate($book);
        $this->assertNotContains('Book must have pages. ', $model->errors());

        $this->assertTrue($model->validate($book));
    }

    public function testSaveAndDestroy()
    {
        $faker = \Faker\Factory::create();
        $model = new Book;

        $book = new stdClass();
        $book->title = $faker->title();
        $book->author = $faker->name();
        $book->pages = $faker->numberBetween(1, 1000);

        $data = Book::findAll();
        $this->assertCount(0, $data);
        $model->save($book);

        $data = Book::findAll();
        $this->assertCount(1, $data);
        $this->assertObjectHasProperty('title', $data[0]);
        $this->assertObjectHasProperty('author', $data[0]);
        $this->assertObjectHasProperty('pages', $data[0]);

        $bookId = $data[0]->id;
        $model->destroy($bookId);
        $data = Book::findAll();
        $this->assertCount(0, $data);
    }
}
