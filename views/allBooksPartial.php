<?php
namespace App\Views\Books;
?>

<ul>
    <?php foreach ($books as $book) : ?>
        <div style="margin-bottom: 34px;">
            <p>Title: <?= $book->Title ?></p>
            <p>Author: <?= $book->Author ?></p>
            <p>Pages: <?= $book->Pages ?></p>
        </div>
    <?php endforeach ?>
    </ul>
    