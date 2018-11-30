<?php snippet('reviews-header', ['campaign_page'=>$campaign_page,'css'=>$css,'hero'=>$hero]) ?>
<main>
  <div class="container">
    <form action="<?= url('reviews-process/'.$campaign_page->slug()) ?>" method="post" id="reviews-form">
      <div id="wrapper">

        <h1<?= $campaign_page?'':' class="error"'?>>
          <?= $campaign_page?$campaign_page->review_title()->value():'Page template is empty'; ?>
        </h1>

        <?= $campaign_page?'<h2>'.$campaign_page->review_subtitle()->value().'</h2>':''; ?>

        <div id="star-ratings">
          <?php for($i=1; $i<=5; $i++) { echo brick('star'); }; ?>
        </div>

        <div id="selected-rating">You selected a rating of <span>0</span> out of 5 stars</div>
        <button type="submit" name="_submit" id="_submit">Submit rating</button>

        <?= $campaign_page?$campaign_page->text()->kt():'Please <a href="'.url().'/panel">login</a> and create a reviews page.' ?>

      </div>

      <div class="logo"><a href="<?= $campaign_page->homepage_url()->value() ?>"><?= $logo ?></a></div>

      <input type="hidden" id="rating" name="rating" value="0">
      <input type="hidden" id="page-type" name="page_type" value="stars">
      <input type="hidden" id="min-rating" name="min-rating" value="<?= $min_rating ?>">
      <input type="hidden" id="token" name="token">
      <input type="hidden" id="source" name="source" value="<?= $utm_source ?>">
      <input type="hidden" id="link_id" name="link_id" value="<?= $link_id ?>">
      <label for="website" class="uniform__potty">Please leave this field blank.</label>
      <input type="text" name="website" id="website" class="uniform__potty" />
    </form>
  </div>
</main>

<?php snippet('reviews-footer', ['campaign_page'=>$campaign_page,'js'=>$js]) ?>
