<!--[if (gte mso 9)|(IE)]>
<table width="616" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
<td>
<![endif]-->
<table align="center" width="100%" style="max-width: 616px" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr style="background-color:#FFFFFF;"><?= clearSpace(3, false, 65, true); ?></tr>
    <tr style="background-color:#FFFFFF;">
      <td width="16"></td>
      <td>
        <h1<?= $page?'':' class="error"'?> style="font-size:2.5rem;font-family:'Source Sans Pro',sans-serif">
          <?= $page?$page->review_title()->value():'Page template is empty'; ?>
        </h1>
      </td>
      <td width="16"></td>
    </tr>
    <tr style="background-color:#FFFFFF;">
      <td width="16"></td>
      <td>
        <?= $page?'<h2 style="font-size:1.4rem;font-family:\'Source Sans Pro\',sans-serif;color:#797979;font-weight:300;line-height:1.25;">'.$page->review_subtitle()->value().'</h2>':''; ?>
      </td>
      <td width="16"></td>
    </tr>
    <?php if($page->email_type()->value() === 'skip'): ?>
      <tr style="background-color:#FFFFFF;">
        <?= clearSpace(false, false, 20, false); ?>
      </tr>
      <tr style="background-color:#FFFFFF;">
        <td colspan="3">
          <!-- Two Columns -->
          <?php snippet('mailer-two-columns', ['page'=>$page, 'logo'=>$logo]) ?>
          <!-- END Two Columns -->
        </td>
      </tr>
      <tr style="background-color:#FFFFFF;">
        <?= clearSpace(false, false, 30, false); ?>
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
    <tr><?= clearSpace(3, false, 50, true); ?></tr>
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
