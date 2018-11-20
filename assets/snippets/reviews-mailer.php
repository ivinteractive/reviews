<!DOCTYPE html>
<html>
<head>
<title>Leave a Review</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style><?= file_get_contents(__DIR__ . DS . '..' . DS . 'css' . DS . 'email.css') ?></style>
<?= $customCss ?>
<style type="text/css">
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; }
    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    table { border-collapse: collapse !important; }
    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
    p {margin:0;}
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
    div[style*="margin: 16px 0;"] { margin: 0 !important; }

    /* WEB FONTS */
    @media screen {

    }

    /* MOBILE STYLES WHERE SUPPORTED */
    @media screen and (max-width: 600px) {

    }
</style>

<body>
<table width="100%" align="center" style="max-width: 616px">
  <tbody>
    <tr><?= clearSpace(3, false, 80, true); ?></tr>
    <tr>
      <td width="100%" colspan="3" style="line-height:0;">
        <a href="<?= url() ?>"><?= $hero ?></a>
      </td>
    </tr>
    <tr>
      <td colspan="3" height="4" bgcolor="<?= $page->hero_border_color()->isNotEmpty()?$page->hero_border_color()->value():'#000000' ?>"></td>
    </tr>
    <tr>
      <td colspan="3" style="background-color: #FFFFFF; border: 1px solid #EEEEEE;">
        <table align="center" width="100%" bgcolor="#FFFFFF">
          <tbody>
            <tr><?= clearSpace(3, false, 65, true); ?></tr>
            <tr>
              <td></td>
              <td>
                <h1<?= $page?'':' class="error"'?> style="font-size:2.5rem;font-family:'Source Sans Pro',sans-serif">
                  <?= $page?$page->review_title()->value():'Page template is empty'; ?>
                </h1>
              </td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td>
                <?= $page?'<h2 style="font-size:1.4rem;font-family:\'Source Sans Pro\',sans-serif;color:#797979;font-weight:300;line-height:1.25;">'.$page->review_subtitle()->value().'</h2>':''; ?>
              </td>
              <td></td>
            </tr>
            <?php if($page->email_type()->value() === 'skip'): ?>
              <tr>
                <?= clearSpace(false, false, 40, false); ?>
              </tr>
              <tr>
                <td></td>
                <td>
                  <table align="center" width="100%">
                    <tbody>
                      <tr>
                        <td align="right">
                          <a href="<?= $page->url() ?>/leave-a-review?link_id=[link_id]">
                            <img src="<?= url() ?>/site/plugins/reviews/assets/images/email-button-green.png" alt="I liked it. Thank you.">
                          </a>
                        </td>
                        <td width="35"></td>
                        <td align="left">
                          <a href="<?= $page->url()?>/feedback">
                            <img src="<?= url() ?>/site/plugins/reviews/assets/images/email-button-red.png" alt="It Could've Been Better.">
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td></td>
              </tr>
              <tr>
                <?= clearSpace(false, false, 20, false); ?>
              </tr>
            <?php else: ?>
              <tr>
                <td></td>
                <td>
                  <?= buttonTag('Leave us a review',$page->url(),$page->reveiw_button_color()->isNotEmpty()?$page->reveiw_button_color()->value():false) ?>
                </td>
                <td></td>
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
      <td colspan="3" height="45" style="line-height:45px;font-size:45px;"></td>
    </tr>
    <tr>
      <td></td>
      <td class="footer">
        <span style="color:#999999!important;font-size:0.65rem;"><?= $page->email_company()->value() ?></span>
        <span style="color:#999999!important;font-size:0.65rem;">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?= $page->contact_link()->value() ?>"><?= $page->contact_text()->isNotEmpty()?$page->contact_text()->value():'Contact Us' ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
        <span style="color:#999999!important;font-size:0.65rem;"><unsubscribe>Unsubscribe</unsubscribe></span>
      </td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td class="footer">
        <span style="color:#999999!important;font-size:0.65rem;"><?= $page->email_footer_address()->kt() ?></span>
      </td>
      <td></td>
    </tr>
    <tr>
      <td colspan="3" height="25" style="line-height:25px;font-size:25px;" class="footer"></td>
    </tr>
    <tr>
      <td colspan="3" style="color:#D7D7D7!important;font-size:0.65rem;" class="footer">
        <table align="center" width="100%">
          <tbody>
            <tr>
              <td></td>
              <td>
                <table align="center">
                  <tbody>
                    <tr style="color:#D7D7D7!important;font-size:0.65rem;">
                      <td><img src="<?= url() ?>/site/plugins/reviews/assets/images/iv-logo-email.png" alt="IV Interactive Logo"></td>
                      <td>&nbsp;&nbsp;Powered by <a href="https://www.ivinteractive.com/" style="color:#D7D7D7!important;">IV Interactive</a></td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3" height="25" style="line-height:25px;font-size:25px;" class="footer"></td>
    </tr>
    <tr>
      <td></td>
      <td style="color: #999999 !important;font-size:0.65rem" class="footer">
        This message contains information which may be confidential and/or privileged. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, use, copy or disclose to anyone the message or any information contained in the message. If you have received the message in error, please advise the sender by reply e-mail and delete the message and any attachment(s) thereto without retaining any copies.
      </td>
      <td></td>
    </tr>
    <tr><?= clearSpace(3, false, 80, true); ?></tr>
  </tbody>
</table>
</body>
</html>
