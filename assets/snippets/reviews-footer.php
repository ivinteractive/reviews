<footer>
  <div class="footer-text">
    <?php
      if(isset($campaign_page) && $campaign_page->footer_text()->isNotEmpty()) {
        echo $campaign_page->footer_text()->kt();
      } elseif(isset($page) && $page->footer_text()->isNotEmpty()) {
        echo $page->footer_text()->kt();
      }
    ?>
  </div>
  <div class="iv-logo">
    <span>Powered by <a href="https://www.ivinteractive.com/" target="_blank">IV Interactive</a></span>
  </div>
  <div class="footer-disclaimer">
    <p>
       This message contains information which may be confidential and/or privileged. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, use, copy or disclose to anyone the message or any information contained in the message. If you have received the message in error, please advise the sender by reply e-mail and delete the message and any attachment(s) thereto without retaining any copies.
    </p>
  </div>
</footer>

<?= $js ?>

</body>
</html>
