<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <title>Leave a Review</title>
  <style><?= file_get_contents(__DIR__ . DS . '..' . DS . 'css' . DS . 'email.css') ?></style>
  <?= $customCss ?>
</head>
<body>
<table width="100%" align="center" style="max-width: 616px">
  <tbody>
    <tr><?= clearSpace(3, false, 80, true); ?></tr>
    <tr>
      <td width="100%" colspan="3">
        <a href="<?= url() ?>"><?= $hero ?></a>
      </td>
    </tr>
    <tr>
      <td colspan="3" height="4" bgcolor="<?= $page->hero_border_color()->isNotEmpty()?$page->hero_border_color()->value():'#000000' ?>"></td>
    </tr>
    <tr>
      <td colspan="3" style="background-color: #FFFFFF; border: 1px solid #EEEEEE;">
        <table align="center" width="100%">
          <tbody>
            <tr><?= clearSpace(3, false, 65, true); ?></tr>
            <tr>
              <td colspan="3">
                <h1<?= $page?'':' class="error"'?> style="font-size:2.5rem;font-family:'Source Sans Pro',sans-serif">
                  <?= $page?$page->review_title()->value():'Page template is empty'; ?>
                </h1>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <?= $page?'<h2 style="font-size:1.4rem;font-family:\'Source Sans Pro\',sans-serif;color:#797979;font-weight:300;line-height:1.25;">'.$page->review_subtitle()->value().'</h2>':''; ?>
              </td>
            </tr>
            <?php if($page->email_type()->value() === 'skip'): ?>
              <tr>
                <?= clearSpace(false, false, 40, false); ?>
              </tr>
              <tr>
                <td colspan="3">
                  <table align="center" width="100%">
                    <tbody>
                      <tr>
                        <td align="right">
                          <a href="<?= $page->url().'/leave-a-review' ?>">
                            <img src="<?= url() ?>/site/plugins/reviews/assets/images/email-button-green.png" alt="I liked it. Thank you.">
                          </a>
                        </td>
                        <td width="35"></td>
                        <td align="left">
                          <a href="<?= $page->url().'/feedback' ?>">
                            <img src="<?= url() ?>/site/plugins/reviews/assets/images/email-button-red.png" alt="It Could've Been Better.">
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <?= clearSpace(false, false, 20, false); ?>
              </tr>
            <?php else: ?>
              <tr>
                <td colspan="3">
                  <?= buttonTag('Leave us a review',$page->url(),$page->reveiw_button_color()->isNotEmpty()?$page->reveiw_button_color()->value():false) ?>
                </td>
              </tr>
            <?php endif; ?>
            </tr>
            <tr>
              <?= clearSpace(false, 20); ?>
              <td style="max-width: 475px"><?= $page->email_text()->kt() ?></td>
              <?= clearSpace(false, 20); ?>
            </tr>
            <tr><?= clearSpace(3, false, 80, true); ?></tr>
            <tr>
              <td colspan="3">
                <a href="<?= url() ?>"><?= $logo ?></a>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3" height="80" style="line-height: 80px; font-size: 80px; border-bottom: 1px solid #EEEEEE;"></td>
    </tr>
    <tr>
      <td colspan="3" height="100" style="color: #999999;" class="footer"><forwardtoafriend>Forward to a Friend</forwardtoafriend></td>
    </tr>
    <tr>
      <td width="203" style="color: #999999;"><?= $page->email_company()->value() ?></td>
      <td width="203" style="border-left: 1px solid #BCBCBC; border-right: 1px solid #BCBCBC;" class="footer">
        <a href="<?= url() ?>" style="color: #999999!important;">Visit our Website</a>
      </td>
      <td width="203" class="footer">
        <a href="<?= $page->social_link()->value() ?>" style="color: #999999!important;"><?= $page->email_social()->value() ?></a>
      </td>
    </tr>
    <tr>
      <td colspan="3" style="color: #999999;" class="footer"><?= $page->email_footer()->kt() ?></td>
    </tr>
    <tr>
      <td colspan="3" height="65" style="color: #999999 !important;" class="footer">
        <unsubscribe>Unsubscribe</unsubscribe>
      </td>
    </tr>
    <tr><?= clearSpace(3, false, 80, true); ?></tr>
  </tbody>
</table>
</body>
</html>
