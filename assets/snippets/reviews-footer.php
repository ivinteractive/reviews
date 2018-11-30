<footer>
  <div class="footer-text">
    <?php
      if(isset($campaign_page) && $campaign_page && $campaign_page->footer_text()->isNotEmpty()) {
        echo $campaign_page->footer_text()->kt();
      } elseif(isset($page) && $page->footer_text()->isNotEmpty()) {
        echo $page->footer_text()->kt();
      }
    ?>
  </div>
  <div class="iv-logo">
    <span>Powered by <a href="https://www.ivinteractive.com/" target="_blank">IV Interactive</a></span>
  </div>
</footer>


<?= '<script type="text/javascript">var campaign_title = "'.(isset($campaign_page) && $campaign_page)?$campaign_page->title():'No Title Set'.'"</script>'; ?>
<?= $js ?>

</body>
</html>
