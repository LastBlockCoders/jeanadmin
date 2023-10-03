<?php


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function Reply_to_customer($con, $status, $cid, $name, $email, $service, $date, $time, $total, $recipients){
    //$reply;
    //$message;
    $serviceName = GetServiceName($con, $service);
    try{
        $sql = "update  tblappointment set Status=? where ID=?;";
        $stmt = mysqli_stmt_init($con);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"si",$status,$cid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        if($status == '0'){
            $reply = "Declined";
        }
        elseif($status == '1'){
            $reply = "Scheduled";
        }
       


        $subject = "Appointment Request Outcome";
        $messageAccept = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="font-family:arial, "helvetica neue", helvetica, sans-serif">
            <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta name="x-apple-disable-message-reformatting">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="telephone=no" name="format-detection">
            <title>New message</title><!--[if (mso 16)]>
            <style type="text/css">
            a {text-decoration: none;}
            </style>
            <![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]>
            <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
            </xml>
            <![endif]-->
            <style type="text/css">
            #outlook a {
            padding:0;
            }
            .es-button {
            mso-style-priority:100!important;
            text-decoration:none!important;
            }
            a[x-apple-data-detectors] {
            color:inherit!important;
            text-decoration:none!important;
            font-size:inherit!important;
            font-family:inherit!important;
            font-weight:inherit!important;
            line-height:inherit!important;
            }
            .es-desk-hidden {
            display:none;
            float:left;
            overflow:hidden;
            width:0;
            max-height:0;
            line-height:0;
            mso-hide:all;
            }
            [data-ogsb] .es-button {
            border-width:0!important;
            padding:10px 30px 10px 30px!important;
            }
            @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120%!important } h1 { font-size:36px!important; text-align:left } h2 { font-size:26px!important; text-align:left } h3 { font-size:20px!important; text-align:left } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:36px!important; text-align:left } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px!important; text-align:left } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important; text-align:left } .es-menu td a { font-size:12px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:14px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button, button.es-button { font-size:20px!important; display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0!important } .es-m-p0r { padding-right:0!important } .es-m-p0l { padding-left:0!important } .es-m-p0t { padding-top:0!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-m-p5 { padding:5px!important } .es-m-p5t { padding-top:5px!important } .es-m-p5b { padding-bottom:5px!important } .es-m-p5r { padding-right:5px!important } .es-m-p5l { padding-left:5px!important } .es-m-p10 { padding:10px!important } .es-m-p10t { padding-top:10px!important } .es-m-p10b { padding-bottom:10px!important } .es-m-p10r { padding-right:10px!important } .es-m-p10l { padding-left:10px!important } .es-m-p15 { padding:15px!important } .es-m-p15t { padding-top:15px!important } .es-m-p15b { padding-bottom:15px!important } .es-m-p15r { padding-right:15px!important } .es-m-p15l { padding-left:15px!important } .es-m-p20 { padding:20px!important } .es-m-p20t { padding-top:20px!important } .es-m-p20r { padding-right:20px!important } .es-m-p20l { padding-left:20px!important } .es-m-p25 { padding:25px!important } .es-m-p25t { padding-top:25px!important } .es-m-p25b { padding-bottom:25px!important } .es-m-p25r { padding-right:25px!important } .es-m-p25l { padding-left:25px!important } .es-m-p30 { padding:30px!important } .es-m-p30t { padding-top:30px!important } .es-m-p30b { padding-bottom:30px!important } .es-m-p30r { padding-right:30px!important } .es-m-p30l { padding-left:30px!important } .es-m-p35 { padding:35px!important } .es-m-p35t { padding-top:35px!important } .es-m-p35b { padding-bottom:35px!important } .es-m-p35r { padding-right:35px!important } .es-m-p35l { padding-left:35px!important } .es-m-p40 { padding:40px!important } .es-m-p40t { padding-top:40px!important } .es-m-p40b { padding-bottom:40px!important } .es-m-p40r { padding-right:40px!important } .es-m-p40l { padding-left:40px!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important } }
            </style>
            </head>
            <body style="width:100%;font-family:arial, "helvetica neue", helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
            <div class="es-wrapper-color" style="background-color:#FAFAFA"><!--[if gte mso 9]>
            <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
            <v:fill type="tile" color="#fafafa"></v:fill>
            </v:background>
            <![endif]-->
            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA">
            <tr>
            <td valign="top" style="padding:0;Margin:0">
            <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
            <tr>
            <td align="center" style="padding:0;Margin:0">
            <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
            <tr>
            <td align="left" style="padding:20px;Margin:0">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td class="es-m-p0r" valign="top" align="center" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0px"><a target="_blank" href="https://jeansmobilebeautyandwellness.co.za" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img src="https://yooxsi.stripocdn.email/content/guids/CABINET_4d74338fe20b10a7525250c115f029c6/images/logo.png"  alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="200" title="Logo" class="adapt-img"></a></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr>
            <td align="center" style="padding:0;Margin:0">
            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
            <tr>
            <td align="left" style="padding:0;Margin:0;padding-top:15px;padding-left:20px;padding-right:20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-bottom:10px"><h1 style="Margin:0;line-height:46px;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:46px;font-style:normal;font-weight:bold;color:#333333"><strong>Hey, '.$name.'</strong></h1></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr>
            <td align="center" style="padding:0;Margin:0">
            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
            <tr>
            <td align="left" style="padding:20px;Margin:0">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0"><h2 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:26px;font-style:normal;color:white;background-color: green;">'.$reply.' !&nbsp;</h2><p>See you soon! Remember to have your card or cash on hand on the day of your appointment to make a payment</p></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            <tr>
            <td align="left" style="padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td class="es-m-p0r" align="center" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-top:2px solid #efefef;border-bottom:2px solid #efefef">
            <tr>
            <td align="left" class="es-m-txt-r" style="padding:0;Margin:0;padding-top:10px;padding-bottom:20px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">Service:&nbsp;<strong>'.$serviceName.'</strong><br>Date:&nbsp;<strong>'.$date.'</strong><br>Time:&nbsp;<strong>'.$time.'</strong><br>Total:&nbsp;<strong>R '.$total.'</strong><br>Recipients:&nbsp;<strong>'.$recipients.'</strong></p></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            <tr>
            <td align="left" style="Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="left" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">Got a question?&nbsp;Email us at&nbsp;<a target="_blank" href="mailto:info@jeansmobilebeautyandwellness.co.za" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">info@</a><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">jeansmobilebeautyandwellness</a><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">.co.za</a>&nbsp;or give us a call at&nbsp;<a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">+27 783 28 5393</a>.</p></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
            <tr>
            <td align="center" style="padding:0;Margin:0">
            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:640px">
            <tr>
            <td align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="left" style="padding:0;Margin:0;width:600px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px;font-size:0">
            <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:40px"><a href="https://www.facebook.com/jeansmobilebeauty/"><img title="Facebook" src="https://yooxsi.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png" alt="Fb" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:40px"><a href="https://wa.me/27783285393?"><img title="Whatsapp" src="https://yooxsi.stripocdn.email/content/assets/img/messenger-icons/logo-black/whatsapp-logo-black.png" alt="Whatsapp" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:40px"><a href="mailto:jeankumwenda802@gmail.com"><img title="Email" src="https://yooxsi.stripocdn.email/content/assets/img/other-icons/logo-black/mail-logo-black.png" alt="Email" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0"><a href="https://jeansmobilebeautyandwellness.co.za"><img title="World" src="https://yooxsi.stripocdn.email/content/assets/img/other-icons/logo-black/globe-logo-black.png" alt="World" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr>
            <td class="es-info-area" align="center" style="padding:0;Margin:0">
            <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" bgcolor="#FFFFFF">
            <tr>
            <td align="left" style="padding:20px;Margin:0">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" class="es-infoblock" style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:14px;color:#CCCCCC;font-size:12px"><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px"></a>No longer want to receive these emails?&nbsp;<a href="" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px">Unsubscribe</a>.<a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px"></a></p></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            </div>
            </body>
            </html>';
    
        
        
        $messageReject = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="font-family:arial, "helvetica neue", helvetica, sans-serif">
            <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta name="x-apple-disable-message-reformatting">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="telephone=no" name="format-detection">
            <title>New message</title><!--[if (mso 16)]>
            <style type="text/css">
            a {text-decoration: none;}
            </style>
            <![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]>
            <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
            </xml>
            <![endif]-->
            <style type="text/css">
            #outlook a {
            padding:0;
            }
            .es-button {
            mso-style-priority:100!important;
            text-decoration:none!important;
            }
            a[x-apple-data-detectors] {
            color:inherit!important;
            text-decoration:none!important;
            font-size:inherit!important;
            font-family:inherit!important;
            font-weight:inherit!important;
            line-height:inherit!important;
            }
            .es-desk-hidden {
            display:none;
            float:left;
            overflow:hidden;
            width:0;
            max-height:0;
            line-height:0;
            mso-hide:all;
            }
            [data-ogsb] .es-button {
            border-width:0!important;
            padding:10px 30px 10px 30px!important;
            }
            @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120%!important } h1 { font-size:36px!important; text-align:left } h2 { font-size:26px!important; text-align:left } h3 { font-size:20px!important; text-align:left } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:36px!important; text-align:left } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px!important; text-align:left } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important; text-align:left } .es-menu td a { font-size:12px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:14px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button, button.es-button { font-size:20px!important; display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0!important } .es-m-p0r { padding-right:0!important } .es-m-p0l { padding-left:0!important } .es-m-p0t { padding-top:0!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-m-p5 { padding:5px!important } .es-m-p5t { padding-top:5px!important } .es-m-p5b { padding-bottom:5px!important } .es-m-p5r { padding-right:5px!important } .es-m-p5l { padding-left:5px!important } .es-m-p10 { padding:10px!important } .es-m-p10t { padding-top:10px!important } .es-m-p10b { padding-bottom:10px!important } .es-m-p10r { padding-right:10px!important } .es-m-p10l { padding-left:10px!important } .es-m-p15 { padding:15px!important } .es-m-p15t { padding-top:15px!important } .es-m-p15b { padding-bottom:15px!important } .es-m-p15r { padding-right:15px!important } .es-m-p15l { padding-left:15px!important } .es-m-p20 { padding:20px!important } .es-m-p20t { padding-top:20px!important } .es-m-p20r { padding-right:20px!important } .es-m-p20l { padding-left:20px!important } .es-m-p25 { padding:25px!important } .es-m-p25t { padding-top:25px!important } .es-m-p25b { padding-bottom:25px!important } .es-m-p25r { padding-right:25px!important } .es-m-p25l { padding-left:25px!important } .es-m-p30 { padding:30px!important } .es-m-p30t { padding-top:30px!important } .es-m-p30b { padding-bottom:30px!important } .es-m-p30r { padding-right:30px!important } .es-m-p30l { padding-left:30px!important } .es-m-p35 { padding:35px!important } .es-m-p35t { padding-top:35px!important } .es-m-p35b { padding-bottom:35px!important } .es-m-p35r { padding-right:35px!important } .es-m-p35l { padding-left:35px!important } .es-m-p40 { padding:40px!important } .es-m-p40t { padding-top:40px!important } .es-m-p40b { padding-bottom:40px!important } .es-m-p40r { padding-right:40px!important } .es-m-p40l { padding-left:40px!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important } }
            </style>
            </head>
            <body style="width:100%;font-family:arial, "helvetica neue", helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
            <div class="es-wrapper-color" style="background-color:#FAFAFA"><!--[if gte mso 9]>
            <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
            <v:fill type="tile" color="#fafafa"></v:fill>
            </v:background>
            <![endif]-->
            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA">
            <tr>
            <td valign="top" style="padding:0;Margin:0">
            <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
            <tr>
            <td align="center" style="padding:0;Margin:0">
            <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
            <tr>
            <td align="left" style="padding:20px;Margin:0">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td class="es-m-p0r" valign="top" align="center" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0px"><a target="_blank" href="https://jeansmobilebeautyandwellness.co.za" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img src="https://yooxsi.stripocdn.email/content/guids/CABINET_4d74338fe20b10a7525250c115f029c6/images/logo.png"  alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="200" title="Logo" class="adapt-img"></a></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr>
            <td align="center" style="padding:0;Margin:0">
            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
            <tr>
            <td align="left" style="padding:0;Margin:0;padding-top:15px;padding-left:20px;padding-right:20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-bottom:10px"><h1 style="Margin:0;line-height:46px;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:46px;font-style:normal;font-weight:bold;color:#333333"><strong>Hey, '.$name.'</strong></h1></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr>
            <td align="center" style="padding:0;Margin:0">
            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
            <tr>
            <td align="left" style="padding:20px;Margin:0">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" class="es-m-txt-c" style="padding:0;Margin:0"><h2 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:26px;font-style:normal;color:white;background-color: red;">'.$reply.' !&nbsp;</h2><p>We are so sorry about this outcome, please do try to request at another time we would appreciate it</p></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            <tr>
            <td align="left" style="padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td class="es-m-p0r" align="center" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-top:2px solid #efefef;border-bottom:2px solid #efefef">
            <tr>
            <td align="left" class="es-m-txt-r" style="padding:0;Margin:0;padding-top:10px;padding-bottom:20px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">Service:&nbsp;<strong>'.$serviceName.'</strong><br>Date:&nbsp;<strong>'.$date.'</strong><br>Time:&nbsp;<strong>'.$time.'</strong><br>Total:&nbsp;<strong>R '.$total.'</strong><br>Recipients:&nbsp;<strong>'.$recipients.'</strong></p></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            <tr>
            <td align="left" style="Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="left" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">Got a question?&nbsp;Email us at&nbsp;<a target="_blank" href="mailto:info@jeansmobilebeautyandwellness.co.za" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">info@</a><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">jeansmobilebeautyandwellness</a><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">.co.za</a>&nbsp;or give us a call at&nbsp;<a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">+27 783 28 5393</a>.</p></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
            <tr>
            <td align="center" style="padding:0;Margin:0">
            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:640px">
            <tr>
            <td align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="left" style="padding:0;Margin:0;width:600px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px;font-size:0">
            <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:40px"><a href="https://www.facebook.com/jeansmobilebeauty/"><img title="Facebook" src="https://yooxsi.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png" alt="Fb" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:40px"><a href="https://wa.me/27783285393?"><img title="Whatsapp" src="https://yooxsi.stripocdn.email/content/assets/img/messenger-icons/logo-black/whatsapp-logo-black.png" alt="Whatsapp" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:40px"><a href="mailto:jeankumwenda802@gmail.com"><img title="Email" src="https://yooxsi.stripocdn.email/content/assets/img/other-icons/logo-black/mail-logo-black.png" alt="Email" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0"><a href="https://jeansmobilebeautyandwellness.co.za"><img title="World" src="https://yooxsi.stripocdn.email/content/assets/img/other-icons/logo-black/globe-logo-black.png" alt="World" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
            <tr>
            <td class="es-info-area" align="center" style="padding:0;Margin:0">
            <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" bgcolor="#FFFFFF">
            <tr>
            <td align="left" style="padding:20px;Margin:0">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr>
            <td align="center" class="es-infoblock" style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:14px;color:#CCCCCC;font-size:12px"><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px"></a>No longer want to receive these emails?&nbsp;<a href="" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px">Unsubscribe</a>.<a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px"></a></p></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table></td>
            </tr>
            </table>
            </div>
            </body>
            </html>';



    if($status == '0'){
        $message = $messageReject;
    } else{
        $message = $messageAccept;
    }
            
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->Port       = 25;
        $mail->Host       = "mail.jeansmobilebeautyandwellness.co.za";
        $mail->Username   = "info@jeansmobilebeautyandwellness.co.za";
        $mail->Password   = "JeanApp2022*";
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
    
    $mail->IsHTML(true);
    
    $mail->AddAddress($email, $name);
    $mail->SetFrom("info@jeansmobilebeautyandwellness.co.za", "Jean's Mobile Beauty and Wellness");
    $mail->Subject =  $subject;
    $content = $message;
    $mail->MsgHTML($content);
    if(!$mail->Send()) {
        
        header("location: new_appointment.php?error=somethingwentwrong");
        exit();
        
    } else{
        header("location: new_appointment.php?error=none");
        exit();

    }   


    }
    catch(mysqli_sql_exception $e){
        header("location: new_appointment.php?error=somethingwentwrong");
        exit();
    }
}

function emptyInputLogIn($email, $password) {
    //$result;
    if(empty($email) || empty($password) ){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email) {
    //$result;
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? $result = TRUE : $result = FALSE;

    //return $result;
}

function invalidPhone($phone){
    //$result;
 // Allow +, - and . in phone number
    $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
 // Remove "-" from number
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
 // Check the length of number
 // This can be customized if you want phone number from a specific country
    if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 10) {
    $result = true;
    } else {
    $result = false;
    }  
    
 return $result;
}

function passwordVerifyLength( $password){

    if(strlen($password) < 8){
        return true;
    } else{
        return false;
    }
}

function passwordMatch( $password, $repassword ){
    //$result;
     if( $password == $repassword){
        $result = false;
     } else {
        $result = true;
     }

     return $result;
}

function emailExists($db, $email){

    try{
    $sql ="SELECT * FROM tclients WHERE email=:email";
    $query=$db->prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0){
      
        return $results;
    }
    else{
        $result = false;
        return $result;
    }

    }  catch(PDOException $ex){
        header("location: ../signup.php?error=somethingwentwrong");
        exit();
    }

  
}

function phoneExists($db, $phone){
    
    try{
        $sql ="SELECT * FROM tclients WHERE phone=:phone";
        $query=$db->prepare($sql);
        $query-> bindParam(':phone', $phone, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
    
        if($query->rowCount() > 0){
            $result = true;
            return $result;
        }
        else{
            $result = false;
            return $result;
        }
    
        }  catch(PDOException $ex){
            header("location: ../signup.php?error=somethingwentwrong");
            exit();
        }
}

function rememberMe($userId){

 $encryptedCookieData = base64_encode("nLBrTF-4MfEtxJ7xBl3GQf34AZYZlEfeBGLAo-l1WCw8-komC5sqLtHmHoW8n5BV{$userId}");

 setcookie("remeberUserCookie", $encryptedCookieData, time()+(10 * 365 * 24 * 60 * 60),"/",FALSE,TRUE);
}

function signout(){
    unset($_SESSION['id']);
    unset($_SESSION['email']);

    if(isset($_COOKIE["remeberUserCookie"])) {
        unset($_COOKIE["remeberUserCookie"]);
        setcookie("remeberUserCookie", null, -1, '/');
    }
    session_destroy();
    session_start();
    session_regenerate_id(true);
    header("location: index.php");
}

#fix
function GetServiceName($con, $id){
    $serv= mysqli_query($con,"SELECT name FROM  tblservices WHERE id = $id;");
    if($serv){
        while ($row = mysqli_fetch_row($serv)) {
           return $row[0];
          }
          mysqli_free_result($serv);
          mysqli_close($con);
        }
    else{
        header("location: dashboard.php?error=somethingwentwrong");
        exit();
    }

}