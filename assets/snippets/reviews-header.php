<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <?= brick('title', ($campaign_page && $campaign_page->metaTitle()->isNotEmpty())?$campaign_page->metaTitle():'Reviews') ?>
  <?= $css ?>
  <?php

    $gtm_code = $campaign_page && $campaign_page->gtm_code()->isNotEmpty()?$campaign_page->gtm_code()->value():false;
    $gtm_script = '';
    $gtm_no_script = '';

    if ($gtm_code) {
      $gtm_script.= "<!-- Google Tag Manager -->";
      $gtm_script.= "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':";
      $gtm_script.= "new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],";
      $gtm_script.= "j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=";
      $gtm_script.= "'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);";
      $gtm_script.= "})(window,document,'script','dataLayer','".$gtm_code."');</script>";
      $gtm_script.= "<!-- End Google Tag Manager -->";

      $gtm_no_script.= '<!-- Google Tag Manager (noscript) -->';
      $gtm_no_script.= '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='.$gtm_code.'"';
      $gtm_no_script.= 'height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
  		$gtm_no_script.= '<!-- End Google Tag Manager (noscript) -->';
    }

    echo $gtm_script;

  ?>
</head>

<body id="reviews">

<?= $gtm_no_script ?>

<header>
  <div class="container">
    <div id="hero">
      <a href="<?= $campaign_page->homepage_url()->isNotEmpty()?$campaign_page->homepage_url()->value():url() ?>">
        <?= $hero ?>
      </a>
    </div>
  </div>
</header>
