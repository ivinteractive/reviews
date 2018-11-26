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
    body[yahoo], body[yahoo] table, body[yahoo] td, body[yahoo] a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    body[yahoo] table, body[yahoo] td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    body[yahoo] img { -ms-interpolation-mode: bicubic; }
    body[yahoo] img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    body[yahoo] table { border-collapse: collapse !important; }
    body[yahoo] { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
    body[yahoo] p {margin:0;}
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
      body[yahoo] .content {width: 616px !important;}
      body[yahoo] .col286 {width: 286px!important;}
    }
    /* WEB FONTS */
    @media screen {

    }
    /* MOBILE STYLES WHERE SUPPORTED */
    @media screen and (max-width: 600px) {
      body[yahoo] .hide-mobile {display: none;}
    }
</style>

<body yahoo>
<!--[if (gte mso 9)|(IE)]>
<table width="616" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
<td>
<![endif]-->
<table width="100%" align="center" class="content" style="max-width: 616px" cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr><?= clearSpace(3, false, 80, true); ?></tr>
    <tr>
      <td width="100%" colspan="3" style="line-height:0;font-size:2.25rem;font-family:'Source Sans Pro',sans-serif;">
        <!--[if (gte mso 9)|(IE)]>
        <table width="616" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td>
        <![endif]-->
        <a href="<?= url() ?>"><?= $hero ?></a>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
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
                          <table width="286" height="65" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <a href="<?= $page->url() ?>/leave-a-review?link_id=[link_id]"  style="color:#4AA922">
                                  <table bgcolor="#FAFDFA" width="230" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid #A9DB94;">
                                    <tr><td height="18" colspan="3"></td></tr>
                                    <tr>
                                      <td width="16"></td>
                                      <td>
                                        <span style="color:#4AA922;font-size:1rem;font-weight:600;font-family:'Source Sans Pro',sans-serif;">
                                          <!--[if (gte mso 9)|(IE)]>
                                          <a href="<?= $page->url() ?>/leave-a-review?link_id=[link_id]"  style="color:#4AA922">
                                          <![endif]-->
                                            <span style="display:inline-block;font-size:20px;margin-right:10px;color:#FFC83D">👍</span>I liked it. Thank you.
                                          <!--[if (gte mso 9)|(IE)]>
                                          </a>
                                          <![endif]-->
                                        </span>
                                      </td>
                                      <td width="16"></td>
                                    </tr>
                                    <tr><td height="18" colspan="3"></td></tr>
                                  </table>
                                </a>
                              </td>
                            </tr>
                            <tr style="background-color:#FFFFFF;">
                              <?= clearSpace(false, false, 20, false); ?>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td><td>
                          <![endif]-->
                          <!--[if (gte mso 9)|(IE)]>
                          <table width="286" align="left" cellpadding="0" cellspacing="0" border="0">
                          <tr>
                          <td>
                          <![endif]-->
                          <table width="100%" height="65" style="width: 100%; max-width: 286px;" class="col286" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <a href="<?= $page->url()?>/feedback" style="color:#C7363B">
                                  <table bgcolor="#FEF9F9" width="230" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid #E88E93;">
                                    <tr><td height="18" colspan="3"></td></tr>
                                    <tr>
                                      <td width="16"></td>
                                      <td>
                                        <span style="color:#C7363B;font-size:1rem;font-weight:600;font-family:'Source Sans Pro',sans-serif;">
                                          <!--[if (gte mso 9)|(IE)]>
                                          <a href="<?= $page->url()?>/feedback" style="color:#C7363B">
                                          <![endif]-->
                                            <span style="display:inline-block;font-size:20px;">&nbsp;</span>It could've been better.
                                          <!--[if (gte mso 9)|(IE)]>
                                          </a>
                                          <![endif]-->
                                        </span>
                                      </td>
                                      <td width="16"></td>
                                    </tr>
                                    <tr><td height="18" colspan="3"></td></tr>
                                  </table>
                                </a>
                              </td>
                            </tr>
                            <tr style="background-color:#FFFFFF;">
                              <?= clearSpace(false, false, 20, false); ?>
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
                <?= clearSpace(false, false, 20, false); ?>
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
            <tr style="background-color:#FFFFFF;"><?= clearSpace(3, false, 60, true); ?></tr>
            <tr style="background-color:#FFFFFF;">
              <td colspan="3">
                <a href="<?= url() ?>"><?= $logo ?></a>
              </td>
            </tr>
            <tr style="background-color:#FFFFFF;"><?= clearSpace(3, false, 50, true); ?></tr>
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
        <span style="color:#999999;font-size:0.65rem;">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?= $page->contact_link()->value() ?>" style="color:#999999;"><?= $page->contact_text()->isNotEmpty()?$page->contact_text()->value():'Contact Us' ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
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
                      <td style="color:#D7D7D7;font-size:0.65rem;">&nbsp;&nbsp;Powered by <a href="https://www.ivinteractive.com/" style="color:#D7D7D7;">IV Interactive</a></td>
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
        <table align="center" width="100%" style="color:#999999;font-size:0.65rem">
          <tbody>
            <tr>
              <td>
                <?= ieEmailSpacer(16) ?>
                <span style="color:#999999;font-size:0.65rem">This message contains information which may be confidential and/or privileged. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, use, copy or disclose to anyone the message or any information contained in the message. If you have received the message in error, please advise the sender by reply e-mail and delete the message and any attachment(s) thereto without retaining any copies.</span>
                <?= ieEmailSpacer(16) ?>
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
