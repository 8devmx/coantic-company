<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

require_once 'medoo.php';
require_once '_db.php';

date_default_timezone_set('America/Mexico_City');

if ($_POST && isset($_POST['accion'])) {
  if (isAjax()) {
    switch ($_POST['accion']) {
      case 'contacto':
        contacto();
        break;
    }
  }
}

function contacto()
{
  date_default_timezone_set("America/Mexico_City");

  array_filter($_POST, 'trim_value');
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
  $msg = '';
  $datos = array(
    'Producto' => $_POST['interesen'],
    'Nombre' => $_POST['nombre'],
    'Teléfono' => $_POST['telefono'],
    'Correo electrónico' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
    'Estado' => $_POST['nom-estado'],
    'Empresa' => $_POST['empresa'],
    '¿Cómo supiste de nosotros?' => $_POST['fuente'],
    'Mensaje' => $_POST['mensaje']
  );
  $espacio = '<br>';

  foreach ($datos as $key => $value) {
    if (!empty($value)) {
      $msg .= "<strong>{$key}: </strong>{$value}{$espacio}";
    }
  }

  $de = $datos['Email'];
  $subjet = "Prospecto de Coatinc Company ";

  $para = $_SESSION["correosPara"];
  $copiaCC = 'abraham_16_69@hotmail.com';
  $copiaCCO = $_SESSION["correosCopiaOculta"];
  $idprod = (($_POST['idprod'] > 0) ? $_POST['idprod'] : 0);

  envio_email($para, $copiaCC, $copiaCCO, $de, $msg);
}


#Limpia los valores
function trim_value(&$value)
{
  $value = trim($value);
}

/**
 * @return bool
 *
 * Funcion para permitir solo llamadas ajax
 */
function isAjax()
{
  return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


function envio_email($para, $copiaCC, $copiaCCO, $de, $msg)
{

  $logo = base_url . "img/logo.svg"; // URL Logotipo para el email Tamaño Maximo 240px Ancho / 45px de alto
  $previo = "";
  $titulo = "Prospecto de Coatinc Company";

  $mensaje = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="x-apple-disable-message-reformatting"> <title></title><!--[if mso]><style>*{font-family: sans-serif !important;}</style><![endif]--> <style>/* What it does: Remove spaces around the email design added by some email clients. */ /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */ html, body{margin: 0 auto !important; padding: 0 !important; height: 100% !important; width: 100% !important;}/* What it does: Stops email clients resizing small text. */ *{-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;}/* What it does: Centers email on Android 4.4 */ div[style*="margin: 16px 0"]{margin:0 !important;}/* What it does: Stops Outlook from adding extra spacing to tables. */ table, td{mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;}/* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */ table{border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;}table table table{table-layout: auto;}/* What it does: Uses a better rendering method when resizing images in IE. */ img{-ms-interpolation-mode:bicubic;}/* What it does: A work-around for iOS meddling in triggered links. */ *[x-apple-data-detectors]{color: inherit !important; text-decoration: none !important;}/* What it does: A work-around for Gmail meddling in triggered links. */ .x-gmail-data-detectors, .x-gmail-data-detectors *, .aBn{border-bottom: 0 !important; cursor: default !important;}/* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */ .a6S{display: none !important; opacity: 0.01 !important;}/* If the above doesnt work, add a .g-img class to any image in question. */ img.g-img + div{display:none !important;}/* What it does: Prevents underlining the button text in Windows 10 */ .button-link{text-decoration: none !important;}/* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89 *//* Create one of these media queries for each additional viewport size youd like to fix *//* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */@media only screen and (min-device-width: 375px) and (max-device-width: 413px){/* iPhone 6 and 6+ */ .email-container{min-width: 375px !important;}}</style><style>/* What it does: Hover styles for buttons */ .button-td, .button-a{transition: all 100ms ease-in;}.button-td:hover, .button-a:hover{background: #555555 !important; border-color: #555555 !important;}/* Media Queries */ @media screen and (max-width: 600px){.email-container{width: 100% !important; margin: auto !important;}/* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */ .fluid{max-width: 100% !important; height: auto !important; margin-left: auto !important; margin-right: auto !important;}/* What it does: Forces table cells into full-width rows. */ .stack-column, .stack-column-center{display: block !important; width: 100% !important; max-width: 100% !important; direction: ltr !important;}/* And center justify these ones. */ .stack-column-center{text-align: center !important;}/* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */ .center-on-narrow{text-align: center !important; display: block !important; margin-left: auto !important; margin-right: auto !important; float: none !important;}table.center-on-narrow{display: inline-block !important;}/* What it does: Adjust typography on small screens to improve readability */ .email-container p{font-size: 17px !important; line-height: 22px !important;}}</style><!--[if gte mso 9]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml><![endif]--> </head><body width="100%" bgcolor="#f5f5f5" style="mso-line-height-rule: exactly;"> <center style="width: 100%; background: #f5f5f5; text-align: left; padding-top: 30px;"> <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;"> ' . $previo . ' </div><table role="presentation" aria-hidden="true" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" width="600" class="email-container"> <tr> <td style="padding: 20px 0; text-align: center;"><div style="background:#000;height:70px;width:100px;text-align:center; display:inline-block;"> <img src="' . $logo . '" aria-hidden="true" width="62" height="68" alt="alt_text" border="0" style="background: #000; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #fff;"></div> </td></tr></table> <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto; border-radius: 10px;" class="email-container"> <tr> <td bgcolor="#ffffff" style="padding: 20px 40px 20px 40px; text-align: center;"> <h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #656a72; font-weight: bold;">' . $titulo . '</h1> </td></tr><tr> <td bgcolor="#ffffff" style="padding: 0 70px 70px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #656a72; text-align: left;"><p style="margin: 0;">' . $msg . '</p></td></tr><tr> <td bgcolor="#ffffff" style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"> <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto"> <tr> <td style="border-radius: 3px; background: #333333; text-align: center;" class="button-td"><a href="mailto:' . $de . '" style="background: #333333; border: 15px solid #333333; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"> &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff;">Responder Solicitud</span>&nbsp;&nbsp;&nbsp;&nbsp; </a> </td></tr></table> </td></tr></table> <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container"> <tr> <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors">Coatinc Company<br>&copy; Todos los derechos reservados ' . date("Y") . '</td></tr></table> </center></body></html>';


  $email = new PHPMailer(true);

  /* - - - - - CONFIGURACION LOCAL PARA ENVIAR CORREOS - - - - - */
  if ($_SERVER['HTTP_HOST'] == "localhost") { //SOLO SI ES LOCALHOST*/
    $email->IsSMTP();
    $email->SMTPAuth = true;
    $email->SMTPSecure = ''; // SSL
    //$email->SMTPDebug = 2;
    $email->Port = 26; //25
    $email->Host = 'mail.coatincmx.com';
    $email->Username = 'sistema@coatincmx.com';
    $email->Password = 'Coatinc!';
  }
  /* - - - - - CONFIGURACION LOCAL PARA ENVIAR CORREOS - - - - - */

  $email->setFrom('contacto@coatinc.com', 'Coatinc Company');
  $email->Subject = "Prospecto de Coatinc Company";
  $email->Body = $mensaje;
  $email->isHTML(true);
  $email->CharSet = 'UTF-8';


  /********************************
                PARA
   *********************************/
  $limpia_correos = str_replace(' ', '', $para);
  $correos = explode(",", $limpia_correos);

  foreach ($correos as $mail) {
    $email->addAddress($mail);
  }

  /********************************
                CON COPIA
   *********************************/
  $limpiaCC_correos = str_replace(' ', '', $copiaCC);
  $correosCC = explode(",", $limpiaCC_correos);

  foreach ($correosCC as $correoCC) {
    $email->addCC($correoCC);
  }
  print_r($email->send());
  if (!$email->send()) {
    $respuesta = $email->ErrorInfo;
  } else {
    $respuesta = 1;
  }
  return $respuesta;
}
