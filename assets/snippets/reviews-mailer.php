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
    @media only screen and (min-device-width: 617px) {
      .content {width: 616px !important;}
      .col290 {width: 290px!important;}
    }
    /* WEB FONTS */
    @media screen {

    }

    /* MOBILE STYLES WHERE SUPPORTED */
    @media screen and (max-width: 600px) {

    }
</style>

<body>
<!--[if (gte mso 9)|(IE)]>
<table width="616" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
<td>
<![endif]-->
<table width="100%" align="center" class="content" style="max-width: 616px" cellpadding="0" cellspacing="0" border="0">
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
            <tr style="background-color:#FFFFFF;"><?= clearSpace(3, false, 65, true); ?></tr>
            <tr style="background-color:#FFFFFF;">
              <?= ieEmailSpacer(16) ?>
              <td>
                <h1<?= $page?'':' class="error"'?> style="font-size:2.5rem;font-family:'Source Sans Pro',sans-serif">
                  <?= $page?$page->review_title()->value():'Page template is empty'; ?>
                </h1>
              </td>
              <?= ieEmailSpacer(16) ?>
            </tr>
            <tr style="background-color:#FFFFFF;">
              <?= ieEmailSpacer(16) ?>
              <td>
                <?= $page?'<h2 style="font-size:1.4rem;font-family:\'Source Sans Pro\',sans-serif;color:#797979;font-weight:300;line-height:1.25;">'.$page->review_subtitle()->value().'</h2>':''; ?>
              </td>
              <?= ieEmailSpacer(16) ?>
            </tr>
            <?php if($page->email_type()->value() === 'skip'): ?>
              <tr style="background-color:#FFFFFF;">
                <?= clearSpace(false, false, 40, false); ?>
              </tr>
              <tr style="background-color:#FFFFFF;">
                <?= ieEmailSpacer(16) ?>
                <td>
                  <table align="center" width="100%">
                    <tbody>
                      <tr>
                        <td>
                          <table width="290" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <a href="<?= $page->url() ?>/leave-a-review?link_id=[link_id]"  style="color:#4AA922">
                                  <table bgcolor="#FAFDFA" bordercolor="#A9DB94" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr><td height="14" colspan="3" style="border:none;"></td></tr>
                                    <tr>
                                      <td width="16" style="border:none;"></td>
                                      <td style="border:none;">
                                        <span style="color:#4AA922;font-size:1rem;font-weight:600;font-family:'Source Sans Pro',sans-serif;">
                                          <span style="display:inline-block;font-size:20px;margin-right:10px;">👍</span>I liked it. Thank you.
                                        </span>
                                      </td>
                                      <td width="16" style="border:none;"></td>
                                    </tr>
                                    <tr><td height="14" colspan="3" style="border:none;"></td></tr>
                                  </table>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td><td>
                          <![endif]-->
                          <!--[if (gte mso 9)|(IE)]>
                          <table width="290" align="left" cellpadding="0" cellspacing="0" border="0">
                          <tr>
                          <td>
                          <![endif]-->
                          <table style="width: 100%; max-width: 290px;" class="col290" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <a href="<?= $page->url()?>/feedback" style="color:#C7363B">
                                  <table bgcolor="#FEF9F9" bordercolor="#E88E93" align="center"  border="1" cellpadding="0" cellspacing="0">
                                    <tr><td height="14" colspan="3" style="border:none;"></td></tr>
                                    <tr>
                                      <td width="16" style="border:none;"></td>
                                      <td style="border:none;">
                                        <span style="color:#C7363B;font-size:1rem;font-weight:600;font-family:'Source Sans Pro',sans-serif;">
                                          <span style="display:inline-block;font-size:20px;">&nbsp;</span>It could've been better.
                                        </span>
                                      </td>
                                      <td width="16" style="border:none;"></td>
                                    </tr>
                                    <tr><td height="14" colspan="3" style="border:none;"></td></tr>
                                  </table>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!--[if (gte mso 9)|(IE)]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <?= ieEmailSpacer(16) ?>
              </tr>
              <tr style="background-color:#FFFFFF;">
                <?= clearSpace(false, false, 40, false); ?>
              </tr>
            <?php else: ?>
              <tr style="background-color:#FFFFFF;">
                <?= ieEmailSpacer(16) ?>
                <td>
                  <?= buttonTag('Leave us a review',$page->url(),$page->reveiw_button_color()->isNotEmpty()?$page->reveiw_button_color()->value():false) ?>
                </td>
                <?= ieEmailSpacer(16) ?>
              </tr>
            <?php endif; ?>
            <tr style="background-color:#FFFFFF;">
              <?= clearSpace(false, 20); ?>
              <!--[if (gte mso 9)|(IE)]>
              <td>
              <table width="475" align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <![endif]-->
              <td style="max-width: 475px"><?= $page->email_text()->kt() ?></td>
              <!--[if (gte mso 9)|(IE)]>
              </tr>
              </table>
              </td>
              <![endif]-->
              <?= clearSpace(false, 20); ?>
            </tr>
            <tr style="background-color:#FFFFFF;"><?= clearSpace(3, false, 80, true); ?></tr>
            <tr style="background-color:#FFFFFF;">
              <td colspan="3">
                <a href="<?= url() ?>"><?= $logo ?></a>
              </td>
            </tr>
            <tr style="background-color:#FFFFFF;"><?= clearSpace(3, false, 56, true); ?></tr>
          </tbody>
        </table>
      </td>
    </tr>

    <?php /**FOOTER**/ ?>
    <tr>
      <td colspan="3" height="45" style="line-height:45px;font-size:45px;"></td>
    </tr>
    <tr>
      <?= ieEmailSpacer(16) ?>
      <td class="footer">
        <span style="color:#999999;font-size:0.65rem;"><?= $page->email_company()->value() ?></span>
        <span style="color:#999999;font-size:0.65rem;">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?= $page->contact_link()->value() ?>"><?= $page->contact_text()->isNotEmpty()?$page->contact_text()->value():'Contact Us' ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
        <span style="color:#999999;font-size:0.65rem;"><unsubscribe>Unsubscribe</unsubscribe></span>
      </td>
      <?= ieEmailSpacer(16) ?>
    </tr>
    <tr>
      <?= ieEmailSpacer(16) ?>
      <td class="footer">
        <span style="color:#999999;font-size:0.65rem;"><?= $page->email_footer_address()->kt() ?></span>
      </td>
      <?= ieEmailSpacer(16) ?>
    </tr>
    <tr>
      <td colspan="3" height="25" style="line-height:25px;font-size:25px;" class="footer"></td>
    </tr>
    <tr>
      <td colspan="3" style="color:#D7D7D7;font-size:0.65rem;" class="footer">
        <table align="center" width="100%">
          <tbody>
            <tr>
              <td></td>
              <td>
                <table align="center">
                  <tbody>
                    <tr style="color:#D7D7D7;font-size:0.65rem;">
                      <td style="color:#D7D7D7;font-size:0.65rem;"><img src="<?= url() ?>/site/plugins/reviews/assets/images/ivi-logo.png" alt="IV Interactive Logo" width="16"></td>
                      <td style="color:#D7D7D7;font-size:0.65rem;">&nbsp;&nbsp;Powered by <a href="https://www.ivinteractive.com/" style="color:#D7D7D7!important;">IV Interactive</a></td>
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
      <?= ieEmailSpacer(16) ?>
      <td class="footer">
        <table align="center" width="616" style="max-width:616px;color:#999999;font-size:0.65rem">
          <tbody>
            <tr>
              <td>
                <span style="color:#999999;font-size:0.65rem">This message contains information which may be confidential and/or privileged. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, use, copy or disclose to anyone the message or any information contained in the message. If you have received the message in error, please advise the sender by reply e-mail and delete the message and any attachment(s) thereto without retaining any copies.</span>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <?= ieEmailSpacer(16) ?>
    </tr>
    <tr><?= clearSpace(3, false, 80, true); ?></tr>
  </tbody>
</table>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
</body>
</html>
