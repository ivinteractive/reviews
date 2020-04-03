<?php snippet('reviews-header', ['campaign_page'=>$campaign_page,'css'=>$css,'hero'=>$hero]) ?>


<main class="feedback <?= $campaign_page->external_template() ?>">
  <div class="container">
    <form action="<?= url('reviews-process/'.$campaign_page->slug()) ?>" method="post" id="reviews-form">
      <?= $campaign_page->low_text()->kt() ?>
      <div id="wrapper">

        <div class="field name">
          <label for="name">Name</label>
          <input type="text" id="name" name="name">
        </div>

        <div class="field email">
          <label for="email">Email</label>
          <input type="email" id="email" name="email">
        </div>

        <div class="field">
          <label for="message">Comments</label>
          <textarea name="message" id="message"></textarea>
        </div>

        <button type="submit" name="_submit" id="_submit" value="<?= get('_submit') ?>">Submit Feedback</button>

      </div>

      <div class="logo">
        <a href="<?= $campaign_page->homepage_url()->isNotEmpty()?$campaign_page->homepage_url()->value():url() ?>">
          <?= $logo ?>
        </a>
      </div>

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

<?php snippet('reviews-footer', ['page'=>$page,'campaign_page'=>$campaign_page,'js'=>$js]) ?>
