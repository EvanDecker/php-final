<?php
namespace Views;

?>
<h1>Delete a Book From Your App</h1>
<?php if ($books === true) : ?>
  <p>Book successfully deleted.</p>
<?php
else : ?>
  <p>Failed to delete book.</p>
  <?php
  $errs = $controller->bookModel->errors();
    foreach($errs as $err) : ?>
      <p><?= $err ?></p>
    <?php endforeach ?>
<?php endif ?>