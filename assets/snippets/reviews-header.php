<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <?= brick('title', ($campaign_page && $campaign_page->metaTitle()->isNotEmpty())?$campaign_page->metaTitle():'Reviews') ?>
  <?= $css ?>
  <?php

    $config_page = page(c::get('reviews-dir', 'reviews'));

    if($campaign_page && $campaign_page->ga_code()->isNotEmpty()) {
      $ga_code = $campaign_page->ga_code()->value();
    } elseif ($config_page && $config_page->ga_code()->isNotEmpty()) {
      $ga_code = $config_page->ga_code()->value();
    } else {
      $ga_code = false;
    }
    $ga_script = '';

    if ($ga_code) {
      $ga_script.= "<!-- Global site tag (gtag.js) - Google Analytics -->";
      $ga_script.= '<script async src="https://www.googletagmanager.com/gtag/js?id='.$ga_code.'"></script>';
      $ga_script.= "<script>";
      $ga_script.= "window.dataLayer = window.dataLayer || [];";
      $ga_script.= "function gtag(){dataLayer.push(arguments);}";
      $ga_script.= "gtag('js', new Date());";
      $ga_script.= "gtag('config', 'UA-130443844-1');";
      $ga_script.= "</script>";
    }

    echo $ga_script;

  ?>
</head>

<body id="reviews">

<header>
  <div class="container">
    <div id="hero">
      <a href="<?= $campaign_page && $campaign_page->homepage_url()->isNotEmpty()?$campaign_page->homepage_url()->value():url() ?>">
        <?= $hero ?>
      </a>
    </div>
  </div>
</header>
