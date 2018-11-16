<?php snippet('reviews-header', ['campaign_page'=>$campaign_page,'css'=>$css,'hero'=>$hero]) ?>


<main>
  <div class="container">
    <form action="<?= url('reviews-process/'.$campaign_page->slug()) ?>" method="post" id="reviews-form">
      <?= $campaign_page->high_text()->kt() ?>
      <div id="wrapper">

				<a class="button" id="external-review-link" href="<?= $externalReview->link()->value() ?>" target="_blank" onclick="externalClicked()">
          <span>Review us on <?= $externalReview->name()->value()?></span>
        </a>
				<?= $campaign_page->text()->kt(); ?>
				<input type="hidden" id="link" name="link" value="<?= $externalReview->link()->value() ?>">
        <input type="hidden" id="clicked" name="clicked">

      </div>

      <div class="logo"><a href="<?= url() ?>"><?= $logo ?></a></div>

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
