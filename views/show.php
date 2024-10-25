<?php
namespace Views;

?>
<h1>Here's the Book You Requested</h1>
<?php
if (!$_GET['id']) : ?>
  <p>Please provide a book ID.</p>
<?php elseif (count($book) < 1) : ?>
  <p>A book with that ID does not exist.</p>
<?php else : ?>
<div style="margin-bottom: 34px;">
  <p>Title: <?= $book[0]->Title ?></p>
  <p>Author: <?= $book[0]->Author ?></p>
  <p>Pages: <?= $book[0]->Pages ?></p>
</div>
<?php endif ?>