<?PHP

function enviarCorreo($asunto, $previsualizacion, $mensajeHTML, $de, $para, $nombrePara, $conCopia)
{
    require_once '../includes/PHPMailer/PHPMailerAutoload.php';
    $respuesta = 0;

    $mensaje = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="x-apple-disable-message-reformatting"> <title></title><!--[if mso]><style>*{font-family: sans-serif !important;}</style><![endif]--> <style>/* What it does: Remove spaces around the email design added by some email clients. */ /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */ html, body{margin: 0 auto !important; padding: 0 !important; height: 100% !important; width: 100% !important;}/* What it does: Stops email clients resizing small text. */ *{-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;}/* What it does: Centers email on Android 4.4 */ div[style*="margin: 16px 0"]{margin:0 !important;}/* What it does: Stops Outlook from adding extra spacing to tables. */ table, td{mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;}/* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */ table{border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;}table table table{table-layout: auto;}/* What it does: Uses a better rendering method when resizing images in IE. */ img{-ms-interpolation-mode:bicubic;}/* What it does: A work-around for iOS meddling in triggered links. */ *[x-apple-data-detectors]{color: inherit !important; text-decoration: none !important;}/* What it does: A work-around for Gmail meddling in triggered links. */ .x-gmail-data-detectors, .x-gmail-data-detectors *, .aBn{border-bottom: 0 !important; cursor: default !important;}/* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */ .a6S{display: none !important; opacity: 0.01 !important;}/* If the above doesnt work, add a .g-img class to any image in question. */ img.g-img + div{display:none !important;}/* What it does: Prevents underlining the button text in Windows 10 */ .button-link{text-decoration: none !important;}/* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89 *//* Create one of these media queries for each additional viewport size youd like to fix *//* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */@media only screen and (min-device-width: 375px) and (max-device-width: 413px){/* iPhone 6 and 6+ */ .email-container{min-width: 375px !important;}}</style><style>/* What it does: Hover styles for buttons */ .button-td, .button-a{transition: all 100ms ease-in;}.button-td:hover, .button-a:hover{background: #555555 !important; border-color: #555555 !important;}/* Media Queries */ @media screen and (max-width: 600px){.email-container{width: 100% !important; margin: auto !important;}/* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */ .fluid{max-width: 100% !important; height: auto !important; margin-left: auto !important; margin-right: auto !important;}/* What it does: Forces table cells into full-width rows. */ .stack-column, .stack-column-center{display: block !important; width: 100% !important; max-width: 100% !important; direction: ltr !important;}/* And center justify these ones. */ .stack-column-center{text-align: center !important;}/* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */ .center-on-narrow{text-align: center !important; display: block !important; margin-left: auto !important; margin-right: auto !important; float: none !important;}table.center-on-narrow{display: inline-block !important;}/* What it does: Adjust typography on small screens to improve readability */ .email-container p{font-size: 17px !important; line-height: 22px !important;}}</style><!--[if gte mso 9]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml><![endif]--> </head><body width="100%" bgcolor="#f5f5f5" style="mso-line-height-rule: exactly;"> <center style="width: 100%; background: #f5f5f5; text-align: left; padding-top: 30px;"> <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;"> ' . $previsualizacion . ' </div><table role="presentation" aria-hidden="true" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" width="600" class="email-container"> <tr> <td style="padding: 20px 0; text-align: center; background: ' . fondoLogo . ';"> <img src="' . logo . '" aria-hidden="true" width="230" height="51" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #fff;"> </td></tr></table> <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto; border-radius: 10px;" class="email-container"> <tr> <td bgcolor="#ffffff" style="padding: 20px 40px 20px 40px; text-align: center;"> <h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #656a72; font-weight: bold;">' . $previsualizacion . '</h1> </td></tr><tr> <td bgcolor="#ffffff" style="padding: 0 70px 70px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #656a72; text-align: left;">
        <p style="margin-top: 15px;">' . $mensajeHTML . '</p>
        </td></tr>';

    $mensaje .= '</table> <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container"> <tr> <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors">' . empresa . '<br>&copy; Todos los derechos reservados ' . date("Y") . '<!--<br><span style="color:#dbdbdb;">' . $para . '</span>--></td></tr></table> </center></body></html>';

    $email = new PHPMailer();

    /* - - - - - CONFIGURACION LOCAL PARA ENVIAR CORREOS - - - - - */
    if ($_SERVER['HTTP_HOST'] == "localhost") { //SOLO SI ES LOCALHOST
        $email->IsSMTP();
        $email->SMTPAuth = true;

        $email->SMTPSecure = 'SSL'; // SSL
        //$email->SMTPDebug = 2;
        $email->Port = 26;
        $email->Host = 'mail.coatincmx.com';
        $email->Username = 'notificaciones@coatincmx.com';
        $email->Password = 'Coatinc!';/**/
    }
    /* - - - - - CONFIGURACION LOCAL PARA ENVIAR CORREOS - - - - - */

    $email->From = $de;
    $email->FromName = $empresa;
    $email->Subject = $asunto;
    $email->Body = $mensaje;
    $email->isHTML(true);
    $email->CharSet = 'UTF-8';

    /*********************************
                DESTINATARIOS
     *********************************/

    /* PARA */
    $email->AddAddress($para, $nombrePara);

    /********************* CON COPIA *********************/
    $limpioConCopia = str_replace(' ', '', $conCopia);
    $arregloConCopia = explode(",", $limpioConCopia);
    foreach ($arregloConCopia as $cuentas) {
        $email->AddCC($cuentas, $cuentas);
    }
    /********************* END CON COPIA *********************/

    if (!$email->send()) {
        $respuesta = $email->ErrorInfo;
        //$respuesta = 1;
    } else {
        $respuesta = 1;
    } //else
    return $respuesta;
}
