<?php extract($form) ?>

<strong>Name:</strong> <?= $name ?><br>
<strong>E-Mail:</strong> <?= $email ?><br>
<strong>Comments:<br></strong><?= $message ?><br><br>

<a href="<?= url().'/reviews-list' ?>">Click here</a> to view all reviews. (You must be logged in)<br><br>
