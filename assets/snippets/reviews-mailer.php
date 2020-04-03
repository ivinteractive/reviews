<!DOCTYPE html>
<html>
<head>
<title>Leave a Review</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
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
    body[yahoo] h2 { font-size: 1.4rem; font-family: 'Source Sans Pro', sans-serif; color: #797979; font-weight: 300; line-height: 1.25; }
    body[yahoo] p { margin:0; font-size: 1rem; }
    body[yahoo] td.footer p { font-size: 0.65rem; }
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
      body[yahoo] .content { width: 616px !important; }
      body[yahoo] .col286 { width: 286px!important; }
    }
    /* WEB FONTS */
    @media screen {}
    /* MOBILE STYLES WHERE SUPPORTED */
    @media only screen and (max-width: 600px) {
      body[yahoo] .hide-mobile {display: none;}
      body[yahoo] br.hide-mobile {display: none;}
      br.hide-mobile {display: none;}
      .hide-mobile {display: none;}
    }

    @media only screen and (min-width: 600px) {
      .break-desktop {
        width:100%;
        display: block !important;
      }
    }

    /* Linked Styles */
		body[yahoo] { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f8f8f8; -webkit-text-size-adjust:none }
		body[yahoo] p { padding:0 !important; margin:0 !important }
		body[yahoo] img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
		body[yahoo] .mcnPreviewText { display: none !important; }

    .column-empty2 { padding-bottom: 20px !important; }

		/* Mobile styles */
		@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
			.mobile-shell { width: 100% !important; min-width: 100% !important; }
			.bg { background-size: 100% auto !important; -webkit-background-size: 100% auto !important; }

			.text-header,
			.m-center { text-align: center !important; }

			.center { margin: 0 auto !important; }
			.container { padding: 20px 10px !important }

			.td { width: 100% !important; min-width: 100% !important; }

			.m-br-15 { height: 15px !important; }
			.p30-15 { padding: 30px 15px !important; }
			.p0-20-0-20 { padding: 0px 20px 0px 20px !important; }
			.p0-15 { padding: 0px 15px !important; }
			.mpb30 { padding-bottom: 30px !important; }
			.mpb15 { padding-bottom: 15px !important; }

			.m-td,
			.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

			.m-block { display: block !important; }

			.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

			.column,
			.column-dir,
			.column-top,
			.column-empty,
			.column-empty2,
			.column-dir-top { float: left !important; width: 100% !important; display: block !important; }

			.column-empty { padding-bottom: 20px !important; }
			.column-empty2 { padding-bottom: 10px !important; }

			.content-spacing { width: 15px !important; }
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
    <tr>
      <td width="100%" colspan="3" style="line-height:0;font-size:2.25rem;font-family:'Source Sans Pro',sans-serif;" cellpadding="0" cellspacing="0" border="0">
        <a href="<?= $page->homepage_url()->isNotEmpty()?$page->homepage_url()->value():url() ?>"><?= $hero ?></a>
      </td>
    </tr>
    <tr>
      <td width="100%" colspan="3" height="4" bgcolor="<?= $page->hero_border_color()->isNotEmpty()?$page->hero_border_color()->value():'#000000' ?>"></td>
    </tr>
    <tr>
      <td width="100%" colspan="3" style="background-color:#FFFFFF;border-left:1px solid #EEEEEE;border-right:1px solid #EEEEEE;border-bottom:1px solid #EEEEEE;">
        <?php if($page->email_template()->isNotEmpty()):
          snippet('mailer-template_'.$page->email_template(), ['page'=>$page, 'logo'=>$logo]);
        else:
          snippet('mailer-template_default', ['page'=>$page, 'logo'=>$logo]);
        endif; ?>
      </td>
    </tr>

    <?php /**FOOTER**/ ?>
    <tr>
      <td colspan="3" height="45" style="line-height:45px;font-size:45px;"></td>
    </tr>
    <tr>
      <td width="16"></td>
      <td class="footer">
        <span style="color:#999999;font-size:0.65rem;"><?= $page->email_company()->value() ?></span>
        <span style="color:#999999;font-size:0.65rem;">
          <?php if($page->contact_link()->isNotEmpty()): ?>
            &nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?= $page->contact_link()->value() ?>" style="color:#999999;">
              <?= $page->contact_text()->isNotEmpty()?$page->contact_text()->value():'Contact Us' ?>
            </a>
          <?php endif;?>&nbsp;&nbsp;|&nbsp;&nbsp;
        </span>
        <span style="color:#999999;font-size:0.65rem;"><unsubscribe>Unsubscribe</unsubscribe></span>
      </td>
      <td width="16"></td>
    </tr>
    <tr>
      <td width="16"></td>
      <td class="footer">
        <span style="color:#999999;font-size:0.65rem;"><?= $page->email_footer_address()->kt() ?></span>
      </td>
      <td width="16"></td>
    </tr>
    <tr>
      <td colspan="3" height="25" style="line-height:25px;font-size:25px;" class="footer"></td>
    </tr>
    <tr>
      <td colspan="3" style="color:#D7D7D7;font-size:0.65rem;" class="footer">
        <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
          <tbody>
            <tr>
              <td></td>
              <td>
                <table align="center" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="color:#D7D7D7;font-size:0.65rem;">
                      <td style="color:#D7D7D7;font-size:0.65rem;"><img src="<?= url() ?>/assets/images/ivi-reviews-logo.png" alt="IV Interactive Logo" width="16"></td>
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
      <td width="16"></td>
      <td class="footer">
        <table align="center" width="100%" style="color:#999999;font-size:0.65rem" cellpadding="0" cellspacing="0" border="0">
          <tbody>
            <tr>
              <td width="16"></td>
              <td>
                <span style="color:#999999;font-size:0.65rem">This message contains information which may be confidential and/or privileged. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, use, copy or disclose to anyone the message or any information contained in the message. If you have received the message in error, please advise the sender by reply e-mail and delete the message and any attachment(s) thereto without retaining any copies.</span>
              </td>
              <td width="16"></td>
            </tr>
          </tbody>
        </table>
      </td>
      <td width="16"></td>
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
