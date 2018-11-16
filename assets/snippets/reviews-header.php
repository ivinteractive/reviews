<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <?= brick('title', ($campaign_page && $campaign_page->metaTitle()->isNotEmpty())?$campaign_page->metaTitle():'Reviews') ?>
  <?= $css ?>
</head>

<body id="reviews">

<header>
  <div class="container">
    <div id="hero"><a href="<?= url() ?>"><?= $hero ?></a></div>
  </div>
</header>
