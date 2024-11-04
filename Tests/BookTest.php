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
}
