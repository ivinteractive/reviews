<!--[if (gte mso 9)|(IE)]>
<table width="616" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
<td>
<![endif]-->
<table align="center" width="100%" style="max-width: 616px" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr style="background-color:#FFFFFF;"><?= clearSpace(3, false, 45, true); ?></tr>
    <tr style="background-color:#FFFFFF;">
      <td width="16"></td>
      <td>
        <h3 style="font-size:1.5rem;font-family:Helvetica,Arial,sans-serif;font-weight:300;color:#000000;">Thanks for your visit!</h3>
        <h1<?= $page?'':' class="error"'?> style="font-size:2rem;line-height:1.4em;font-family:Helvetica,Arial,sans-serif;margin-bottom:1.25rem;font-weight:300;">
          <?= $page?$page->review_title()->value():'Page template is empty'; ?>
        </h1>
      </td>
      <td width="16"></td>
    </tr>
    <tr style="background-color:#FFFFFF;">
      <td width="16"></td>
      <td>
        <?= $page?'<div style="font-size:1rem;color:#525252;font-family:Helvetica,Arial,sans-serif;line-height:1.25;font-weight:400">'.$page->review_subtitle()->value().'</div>':''; ?>
      </td>
      <td width="16"></td>
    </tr>
    <?php if($page->email_type()->value() === 'skip'): ?>
      <tr style="background-color:#FFFFFF;">
        <?= clearSpace(false, false, 20, false); ?>
      </tr>
      <tr style="background-color:#FFFFFF;">
        <td colspan="3">
          <!--[if (gte mso 9)|(IE)]>
          <table width="269" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td>
          <![endif]-->
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 269px;">
            <!-- Button -->
            <tr>
              <td class="text-link" style="color:#4AA922;font-size:1.125rem;font-weight:600;font-family:Helvetica,Arial,sans-serif;line-height:28px;text-align:center;background-color:#FAFDFA;padding:15px;border: 1px solid #A9DB94;">
                <a href="<?= $page->url() ?>/leave-a-review?link_id=[link_id]" target="_blank" class="link-u" style="color:#4AA922; text-decoration:underline;">
                  <span class="link-u" style="color:#4AA922;text-decoration:underline;">
                    <!--[if (gte mso 9)|(IE)]>
                    <a href="<?= $page->url() ?>/leave-a-review?link_id=[link_id]" style="color:#4AA922;text-decoration:underline;">
                    <![endif]-->
                      <span style="display:inline-block;margin-right:10px;color:#FFC83D">👍</span>Leave Us a Review!
                    <!--[if (gte mso 9)|(IE)]>
                    </a>
                    <![endif]-->
                  </span>
                </a>
              </td>
            </tr>
            <!-- END Button -->
          </table>
          <!--[if (gte mso 9)|(IE)]>
          </td>
          </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
      <tr style="background-color:#FFFFFF;">
        <?= clearSpace(false, false, 50, false); ?>
      </tr>
    <?php else: ?>
      <tr style="background-color:#FFFFFF;">
        <td width="16"></td>
        <td>
          <?= buttonTag('Leave us a review',$page->url(),$page->reveiw_button_color()->isNotEmpty()?$page->reveiw_button_color()->value():false) ?>
        </td>
        <td width="16"></td>
      </tr>
    <?php endif; ?>
    <tr style="background-color:#FFFFFF;">
      <?= clearSpace(false, 20); ?>
      <td>
        <!--[if (gte mso 9)|(IE)]>
        <table width="400" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td>
        <![endif]-->
        <table width="100%" style="max-width: 400px" align="center">
          <tbody>
            <tr>
              <td><?= $page->email_text()->kt() ?></td>
            </tr>
          </tbody>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
      <?= clearSpace(false, 20); ?>
    </tr>
    <tr style="background-color:#FFFFFF;">
      <?= clearSpace(false, false, 30, false); ?>
    </tr>
    <tr style="background-color:#FFFFFF;">
      <td colspan="3">
        <!--[if (gte mso 9)|(IE)]>
        <table width="269" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td>
        <![endif]-->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 269px;">
          <!-- Button -->
          <tr>
            <td class="text-link" style="color:#C7363B;font-size:1.125rem;font-weight:600;font-family:Helvetica,Arial,sans-serif;line-height:28px;text-align:center;background-color:#FEF9F9;padding:15px;border:1px solid #E88E93;">
              <a href="<?= $page->url()?>/feedback" target="_blank" class="link-u" style="color:#C7363B; text-decoration:underline;">
                <span class="link-u" style="color:#C7363B;text-decoration:underline;">
                  <!--[if (gte mso 9)|(IE)]>
                  <a href="<?= $page->url()?>/feedback" style="color:#C7363B;text-decoration:underline;">
                  <![endif]-->
                    Contact Us Directly
                  <!--[if (gte mso 9)|(IE)]>
                  </a>
                  <![endif]-->
                </span>
              </a>
            </td>
          </tr>
          <!-- END Button -->
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <tr style="background-color:#FFFFFF;">
      <?= clearSpace(false, false, 30, false); ?>
    </tr>
    <tr><?= clearSpace(3, false, 25, true); ?></tr>
    <tr>
      <td colspan="3">
        <a href="<?= $page->homepage_url()->isNotEmpty()?$page->homepage_url()->value():url() ?>"><?= $logo ?></a>
      </td>
    </tr>
    <tr><?= clearSpace(3, false, 50, true); ?></tr>
  </tbody>
</table>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
