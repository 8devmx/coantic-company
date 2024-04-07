<?php
error_reporting(0);

if (is_session_started() === FALSE) session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once '_db.php';

define("base_dir", realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
define("upload_dir", base_dir . 'cache' . DIRECTORY_SEPARATOR);

$proyecto = 'Coatinc';

$arrayCarpetas = explode("/", $_SERVER['PHP_SELF']);
$siCarpetaProyecto = ((strlen($arrayCarpetas[0]) > 0) ? $arrayCarpetas[0] : $arrayCarpetas[1]);
$carpetaProyecto = ((strlen($siCarpetaProyecto) > 0) ? "/" . $siCarpetaProyecto . "/" : "/");

if ($_SERVER['HTTP_HOST'] == "localhost") {

    define("base_url", "http://" . $_SERVER['HTTP_HOST'] . "" . $carpetaProyecto . "backend/");
    define("basesite_url", "http://" . $_SERVER['HTTP_HOST'] . "" . $carpetaProyecto . "");

    $url_actual = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
} else {

    define("base_url", "https://" . $_SERVER['HTTP_HOST'] . "" . $carpetaProyecto . "");
    define("basesite_url", "https://" . $_SERVER['HTTP_HOST'] . "/");

    $url_actual = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

define("empresa", $proyecto);
define("directorioGaleria", "blog");
define("logo", base_url . "img/logo.svg");
define("fondoLogo", "#000");

define("llaveGoogleMaps", "AIzaSyCtlCJnfrK7Z1FALD5FWZwx-EdvWKZHt64");

//Configuracion para poner los errores y warnings en los logs
ini_set("log_errors", "1");
ini_set("error_log", upload_dir . "errors.log");
ini_set("display_errors", "0");

$sec = "";
$seccion_actual = "";
$cadena_bullets = "<ul><li>Titulo 1</li><li>Titulo 2</li><li>Titulo 3</li></ul>";


$man = "0";
if ($url !== base_url && $man === "1") {
    header("location: " . base_url . "logout.php");
}

// ARRAY de las Secciones Administrables por cada usuario
if (isset($_SESSION["session"])) {
    $sec = explode("**", $_SESSION['modulos']);
}

require_once '_modulos.php';


// FUNCIONES DE LOGIN - CONTRASEÑAS - CONTACTO
if ($_POST) {
    switch ($_POST['accion']) {
        case 'contacto':
            contacto();
            break;

        case 'login':
            login();
            break;

        case 'forgot':
            forgot();
            break;

        case 'recovery':
            recovery();
            break;

        case 'eliminarSeleccion':
            eliminarSeleccion();
            break;
    }
}

function is_session_started()
{
    if (php_sapi_name() !== 'cli') {
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

function filtro($data)
{
    return $data;
}

function eliminarSeleccion()
{
    global $db;
    foreach ($_POST as $key => $value) {
        $post[$key] = filtro($value);
    }
    //$db->delete("tbl_llantas", ["id_tveh" => $post['id']]);
    $contador = 0;
    foreach ($post['arregloID'] as $value) {

        $resp = $db->update($post['tabla'], [
            "activo_" . $post['termino'] => 0
        ], ["id_" . $post['termino'] => $value]);

        if ($resp) {
            $contador++;
        }
    }

    echo $contador;
}

function login()
{
    global $db;
    foreach ($_POST as $key => $value) {
        $data[$key] = filtro($value); // POST pasa por un filtro   filtro($value);
    }

    $respuesta = [
        "status" => 0,
        "texto" => false,
    ];
    if ($data['usuario'] !== "" || $data["password"] !== "") {

        $usuario = trim($data['usuario']);
        $password = md5($data['password']);

        $sqlVal = "SELECT *,COUNT(id_usr) AS existe FROM usuarios WHERE usuario_usr = '" . $usuario . "' AND clave_usr = '" . $password . "'; ";
        $resVal = $db->query($sqlVal)->fetchAll(PDO::FETCH_ASSOC);
        $siExiste = $resVal[0]['existe'];
        if ($siExiste > 0) {
            if ($resVal[0]['activo_usr'] == 1) {
                session_start();
                $_SESSION['id'] = $resVal[0]['id_usr'];
                $_SESSION['nombre'] = $resVal[0]['nombre_usr'];
                $_SESSION['correo'] = $resVal[0]['correo_usr'];
                $_SESSION['nivel'] = $resVal[0]['permisos_usr'];
                $_SESSION['ultimoacceso'] = $resVal[0]['login_usr'];
                $_SESSION['session'] = "admin";
                $_SESSION['modulos'] = $resVal[0]['modulos_usr'];

                $respuesta = [
                    "status" => 1,
                    "texto" => true,
                ];
            } else {
                $respuesta = [
                    "status" => 0,
                    "texto" => "bloqueado",
                ];
            }
        } else {
            $respuesta = [
                "status" => 0,
                "texto" => "noexiste",
            ];
        }
    } else {
        $respuesta = [
            "status" => 0,
            "texto" => "vacio",
        ];
    }
    echo json_encode($respuesta);
}

function forgot()
{
    global $db;
    $email = trim(strtolower($_POST['email']));

    $consulta = $db->get("usuarios", "*", ["correo_usr" => $email]);
    $usuario = $consulta['nombre_usr'];
    $hash1 = md5($consulta['id_usr']);
    $hash2 = md5($consulta['correo_usr']);
    $respuesta = [
        "status" => 0,
        "texto" => false
    ];
    if ($consulta) {
        $para = $email;
        $de = 'Coatinc <soporte@coatinc.mx>';
        $subjet = 'Recuperacion de cuenta backend.';
        $tipo = 'Recuperaci&oacute;n de cuenta';
        $titulo = 'Recuperaci&oacute;n de Contraseña';
        $msg = '
        Estimado(a) <strong>' . $usuario . '</strong> se ha registrado una solicitud de cambio de contraseña en su cuenta.
        <br/><br/>
        Si usted no ha realizado esta solicitud, ignore este e-mail, en caso contrario para <strong>reiniciar</strong> su contraseña de <strong>click</strong> en el siguiente link:
        <br/><br/>
        <a href="' . base_url . '?recovery=' . $hash1 . $hash2 . '">Restablecer contraseña ahora.</a>
        <br/><br/>
        Que tenga buen d&iacute;a.';

        envio_email($para, $de, $subjet, $tipo, $titulo, $msg);
        $respuesta = [
            "status" => 0,
            "texto" => true
        ];
    }
    echo json_encode($respuesta);
}

function recovery()
{
    global $db;
    $res1 = substr($_POST['hash'], 0, 32);
    $res2 = substr($_POST['hash'], 32, 64);

    $consulta = $db->query("SELECT * FROM usuarios WHERE md5(id_usr) = '$res1' AND md5(correo_usr) = '$res2'")->fetchAll();

    $password = md5($_POST['password']);
    $respuesta = [
        "status" => 0,
        "texto" => false
    ];
    if (empty($consulta)) {
        echo json_encode($respuesta);
    } else {
        $actualiza = $db->update("usuarios", ["clave_usr" => $password], ["id_usr" => $consulta[0]["id_usr"]]);

        $para = $consulta[0]['correo_usr'];
        $de = 'Coatinc <soporte@coatinc.mx>';
        $subjet = 'Cambio de contraseña Nanodepot CRM.';
        $tipo = 'Cambio de contraseña';
        $titulo = 'Cambio de contraseña exitoso.';
        $msg = '
        Estimado(a) <strong>' . $consulta[0]['nombre_usr'] . '</strong> su cambio de contraseña se ha realizado con &eacute;xito.
        <br/><br/>
        Si usted no ha realizado este proceso favor de contactarse al corporativo para la verificaci&oacute;n de su cuenta.
        <br/><br/>
        Que tenga buen d&iacute;a.';

        envio_email($para, $de, $subjet, $tipo, $titulo, $msg);

        $respuesta = [
            "status" => 1,
            "texto" => true
        ];
        echo json_encode($respuesta);
    }
}

function logout()
{
    global $db;
    session_start();

    /* Elimina las sesiones*************** */
    unset($_SESSION['id']);
    unset($_SESSION['nombre']);
    unset($_SESSION['nivel']);
    unset($_SESSION['ultimoacceso']);
    unset($_SESSION['session']);
    unset($_SESSION['modulos']);
    unset($_SESSION['HTTP_USER_AGENT']);
    session_unset();
    session_destroy();

    header("Location: " . base_url);
}

// VERIFICA EL LOGIN
function page_protect()
{
    session_start();

    if (!is_numeric($_SESSION['id'])) {
        header("Location: " . base_url);
        exit();
    }
}


function GenKey($length = 7)
{
    $password = "";
    $possible = "0123456789abcdefghijkmnopqrstuvwxyz";

    $i = 0;

    while ($i < $length) {


        $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);


        if (!strstr($password, $char)) {
            $password .= $char;
            $i++;
        }
    }

    return $password;
}

function envio_email($para, $de, $subjet, $tipo, $titulo, $msg)
{
    $logo = base_url . "img/logo_header.png";
    $link = base_url;
    $tlink = "sistema.controldecarga.com";

    $destinatario = $para;
    $asunto = $subjet;
    $color = "#303030";
    $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Documento sin título</title>
    </head>
    <body style="background-color: #ddd;">
        <table id="pageContainer" width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; background-repeat:repeat; "> 
            <tbody>
                <tr> 
                    <td style="padding:30px 20px 40px 20px;"> 
                        <table width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;"> 
                            <tbody> 
                                <tr> 
                                    <td bgcolor="' . $color . '" colspan="2" height="7" style="font-size:2px; line-height:0px;">
                                        <img alt="" height="7" src="http://www.coatinc.mx/img/mail/blank.gif" width="600" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td bgcolor="' . $color . '" width="255" valign="middle" style="padding:25px 28px 25px 28px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:' . $color . ';"> 
                                        <a href="http://www.coatinc.mx/"><img alt="Logo" src="' . $logo . '" align="left" border="0" vspace="0" hspace="0" style="display:block;"> </a>
                                    </td> 
                                    <td bgcolor="' . $color . '" width="255" valign="middle" style="padding:20px 20px 15px 0; font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:100%; color:#777777; text-align:right;"> 
                                        <table width="254" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:center; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:100%; color:#777777;"> 
                                            <tbody>
                                                <tr> 
                                                    <td width="66" valign="top" style="line-height:100%; color:#fff;"> 
                                                        <img alt="●" src="http://www.coatinc.mx/img/mail/calendarIcon.png" height="32" width="32" border="0" vspace="0" hspace="17" style="display:block;"> 
                                                        ' . ucfirst(strftime("%b %d")) . ' 
                                                    </td> 
                                                    <td width="20" style="padding:0 10px; line-height:100%; text-align:center;">
                                                        <img alt="" src="http://www.coatinc.mx/img/mail/separatorw.png" width="20" height="50" border="0" style="vertical-align:0px; display:block;">
                                                    </td> 
                                                    <td width="64" valign="top" style="line-height:100%;"> 
                                                        <a href="mailto:' . $de . '" style="text-decoration:none; color:#fff; display:block; line-height:100%;">
                                                            <img alt="●" src="http://www.coatinc.mx/img/mail/forwardIcon.png" height="32" width="32" border="0" vspace="0" hspace="11" style="display:block;"> 
                                                            Responder
                                                        </a> 
                                                    </td> 
                                                    <td width="20" style="padding:0 10px; line-height:100%; text-align:center;">
                                                        <img alt="" src="http://www.coatinc.mx/img/mail/separatorw.png" width="20" height="50" border="0" style="vertical-align:0px; display:block;">
                                                    </td> 
                                                    <td width="54" valign="top" style="line-height:100%;"> 
                                                        <a href="' . $link . '" style="text-decoration:none; color:#fff; display:block; line-height:100%;">
                                                            <img alt="●" src="http://www.coatinc.mx/img/mail/websiteIcon.png" height="32" width="32" border="0" vspace="0" hspace="11" style="display:block;"> 
                                                            Backend
                                                        </a> 
                                                    </td> 
                                                </tr> 
                                            </tbody>
                                        </table> 
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td colspan="2" height="11" style="font-size:2px; line-height:0px;">
                                        <img alt="" src="http://www.coatinc.mx/img/mail/divider.png" height="11" width="600" align="left" border="0" vspace="0" hspace="0" style="display:block;">
                                    </td> 
                                </tr> 
                            </tbody>
                        </table> 

                        <table bgcolor="#ffffff" width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;"> 
                            <tbody>
                                <tr> 
                                    <td style="padding-top:20px; padding-right:30px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#aaaaaa;"> 
                                        <img alt="" src="http://www.coatinc.mx/img/mail/dateIcon.png" height="14" width="12" border="0" vspace="0" hspace="0" style="vertical-align:-1px;" />&nbsp;&nbsp; ' . date("d.m.y") . ' &nbsp;&nbsp;
                                        <img alt="" src="http://www.coatinc.mx/img/mail/categoryIcon.png" height="14" width="15" border="0" vspace="0" hspace="0" style="vertical-align:-2px;" />&nbsp;&nbsp; ' . $tipo . ' 
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td style="padding-top:20px; padding-right:40px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;"> 
                                        <p style="font-family: Segoe UI, Helvetica Neue, Helvetica, Arial, sans-serif; font-size:30px; line-height:30pt; color:#3b5167; font-weight:300; margin-top:0; margin-bottom:20px !important; padding:0; text-indent:-3px;">' . $titulo . '</p> 
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td style="padding-right:30px; padding-bottom:30px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;">   
                                        ' . $msg . '
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td height="11" style="font-size:2px; line-height:0px;">
                                        <img alt="" src="http://www.coatinc.mx/img/mail/divider.png" height="11" width="600" align="left" border="0" vspace="0" hspace="0" style="display:block;">
                                    </td> 
                                </tr> 
                            </tbody>
                        </table> 
                        <table bgcolor="#f4f4f4" width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;"> 
                            <tbody>
                                <tr> 
                                    <td> 
                                        <table width="600" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;"> 
                                            <tbody>
                                                <tr> 
                                                    <td width="30">
                                                        <img alt="" height="10" src="http://www.coatinc.mx/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                    </td> 
                                                    <td width="160" valign="top" style="padding-top:30px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;"> 
                                                        Copyright &COPY; ' . date("Y") . '<br/>
                                                        <a style="text-decoration:underline; color:' . $color . ';" href="' . $link . '">' . $tlink . '</a> 
                                                        <br/>
                                                        All rights reserved.
                                                    </td> 
                                                    <td width="30">
                                                        <img alt="" height="10" src="http://www.coatinc.mx/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                    </td> 
                                                    <td width="160" valign="top" style="padding-top:34px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;"> 
                                                        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:100%; color:#777777;"> 
                                                            <tbody>
                                                                <tr> 
                                                                    <td class="footer_list_image" width="20" valign="top" style="padding:0 0 9px 0;">
                                                                        <img alt="●" src="http://www.coatinc.mx/img/mail/homeIcon.png" width="13" height="12" border="0" align="left" style="display:block;">
                                                                    </td> 
                                                                    <td class="footer_list" width="140" valign="top" style="padding:0 0 9px 0; line-height:9pt;"> 
                                                                        <a href="' . $link . '" style="text-decoration:underline; color:' . $color . '; line-height:9pt;"> ' . $tlink . '</a> 
                                                                    </td> 
                                                                </tr> 
                                                                <tr> 
                                                                    <td class="footer_list_image" width="20" valign="top" style="padding:0 0 9px 0;">
                                                                        <img alt="●" src="http://www.coatinc.mx/img/mail/emailIcon.png" width="12" height="12" border="0" align="left" style="display:block;">
                                                                    </td> 
                                                                    <td class="footer_list" width="140" valign="top" style="padding:0 0 9px 0; line-height:9pt;"> 
                                                                        <a href="mailto:' . $de . '" style="text-decoration:underline; color:' . $color . '; line-height:9pt;"> ' . $de . '</a> 
                                                                    </td> 
                                                                </tr> 
                                                                <tr> 
                                                                    <td class="socialIcons" colspan="2" style="padding-top:17px; padding-bottom:5px;"> 
                                                                        <a href="#"><img alt="Facebook" src="http://www.coatinc.mx/img/mail/facebookIcon.png" border="0" vspace="0" hspace="0"></a>&nbsp;&nbsp; 
                                                                        <a href="#"><img alt="Twitter" src="http://www.coatinc.mx/img/mail/twitterIcon.png" border="0" vspace="0" hspace="0"></a>&nbsp;&nbsp; 
                                                                    </td> 
                                                                </tr> 
                                                            </tbody>
                                                        </table> 
                                                    </td> 
                                                    <td width="30">
                                                        <img alt="" height="10" src="http://www.coatinc.mx/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                    </td> 
                                                    <td width="160" valign="top" style="padding-top:30px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;"> 
                                                        <strong>Email de Notificación</strong><br/> Estos emails unicamente son para referencias futuras.<br/><br/>
                                                    </td> 
                                                    <td width="30">
                                                        <img alt="·" height="10" src="http://www.coatinc.mx/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                    </td> 
                                                </tr> 
                                            </tbody>
                                        </table> 
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td bgcolor="' . $color . '" height="7" style="font-size:2px; line-height:0px;"><img alt="" height="7" src="http://www.coatinc.mx/img/mail/blank.gif" width="600" align="left" vspace="0" hspace="0" border="0" style="display:block;"></td> 
                                </tr> 
                            </tbody>
                        </table> 
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
    </html>
    ';

    $headers = "From: Coatinc <soporte@coatincmx.com> \r\n";
    $headers .= "X-Mailer: PHP5\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    mail($destinatario, $asunto, $mensaje, $headers);
}


// REEMPLAZA CARACTERES PARA URL AMIGABLE
function replaceUrl($string)
{
    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
}


// REDIMENSIONA GENERAL
function redim($ruta1, $ruta2, $ancho, $alto)
{
    # se obtiene la dimension y tipo de imagen
    $datos = getimagesize($ruta1);

    $ancho_orig = $datos[0]; # Anchura de la imagen original
    $alto_orig = $datos[1];    # Altura de la imagen original
    $tipo = $datos[2];

    if ($tipo == 1) { # GIF
        if (function_exists("imagecreatefromgif"))
            $img = imagecreatefromgif($ruta1);
        else
            return false;
    } else if ($tipo == 2) { # JPG
        if (function_exists("imagecreatefromjpeg"))
            $img = imagecreatefromjpeg($ruta1);
        else
            return false;
    } else if ($tipo == 3) { # PNG
        if (function_exists("imagecreatefrompng"))
            $img = imagecreatefrompng($ruta1);
        else
            return false;
    }

    # Se calculan las nuevas dimensiones de la imagen
    if ($ancho_orig > $alto_orig) {
        $ancho_dest = $ancho;
        $alto_dest = ($ancho_dest / $ancho_orig) * $alto_orig;
    } else {
        $alto_dest = $alto;
        $ancho_dest = ($alto_dest / $alto_orig) * $ancho_orig;
    }

    // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+
    $img2 = @imagecreatetruecolor($ancho_dest, $alto_dest) or $img2 = imagecreate($ancho_dest, $alto_dest);

    // Redimensionar
    // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+
    @imagecopyresampled($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig) or imagecopyresized($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig);

    // Crear fichero nuevo, según extensión.
    if ($tipo == 1) // GIF
        if (function_exists("imagegif"))
            imagegif($img2, $ruta2);
        else
            return false;

    if ($tipo == 2) // JPG
        if (function_exists("imagejpeg"))
            imagejpeg($img2, $ruta2);
        else
            return false;

    if ($tipo == 3)  // PNG
        if (function_exists("imagepng"))
            imagepng($img2, $ruta2);
        else
            return false;

    return true;
}

// RESIZE DE LAS IMAGENES CON FORMATO TOTALMENTE CUADRADO
if (!function_exists("create_square_image")) {

    function create_square_image($original_file, $destination_file = NULL, $square_size = 100)
    {
        // get width and height of original image
        $imagedata = getimagesize($original_file);
        $original_width = $imagedata[0];
        $original_height = $imagedata[1];

        if ($original_width > $original_height) {
            $new_height = $square_size;
            $new_width = $new_height * ($original_width / $original_height);
        }
        if ($original_height > $original_width) {
            $new_width = $square_size;
            $new_height = $new_width * ($original_height / $original_width);
        }
        if ($original_height == $original_width) {
            $new_width = $square_size;
            $new_height = $square_size;
        }

        $new_width = round($new_width);
        $new_height = round($new_height);

        // load the image
        if (substr_count(strtolower($original_file), ".jpg") or substr_count(strtolower($original_file), ".jpeg") or substr_count(strtolower($original_file), ".JPG") or substr_count(strtolower($original_file), ".JPEG")) {
            $original_image = imagecreatefromjpeg($original_file);
        }
        if (substr_count(strtolower($original_file), ".gif")) {
            $original_image = imagecreatefromgif($original_file);
        }
        if (substr_count(strtolower($original_file), ".png")) {
            $original_image = imagecreatefrompng($original_file);
        }

        $smaller_image = imagecreatetruecolor($new_width, $new_height);
        $square_image = imagecreatetruecolor($square_size, $square_size);

        imagecopyresampled($smaller_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

        if ($new_width > $new_height) {
            $difference = $new_width - $new_height;
            $half_difference = round($difference / 2);
            imagecopyresampled($square_image, $smaller_image, 0 - $half_difference + 1, 0, 0, 0, $square_size + $difference, $square_size, $new_width, $new_height);
        }
        if ($new_height > $new_width) {
            $difference = $new_height - $new_width;
            $half_difference = round($difference / 2);
            imagecopyresampled($square_image, $smaller_image, 0, 0 - $half_difference + 1, 0, 0, $square_size, $square_size + $difference, $new_width, $new_height);
        }
        if ($new_height == $new_width) {
            imagecopyresampled($square_image, $smaller_image, 0, 0, 0, 0, $square_size, $square_size, $new_width, $new_height);
        }


        // if no destination file was given then display a png      
        if (!$destination_file) {
            imagepng($square_image, NULL, 9);
        }

        // save the smaller image FILE if destination file given
        if (substr_count(strtolower($destination_file), ".jpg") or substr_count(strtolower($destination_file), ".jpeg")) {
            imagejpeg($square_image, $destination_file, 100);
        }
        if (substr_count(strtolower($destination_file), ".gif")) {
            imagegif($square_image, $destination_file);
        }
        if (substr_count(strtolower($destination_file), ".png")) {
            imagepng($square_image, $destination_file, 9);
        }

        imagedestroy($original_image);
        imagedestroy($smaller_image);
        imagedestroy($square_image);
    }
}

function eliminar_tildes($palabra)
{

    //Codificamos la cadena en formato utf8 en caso de que nos de errores
    $caden = str_replace(" ", "_", $palabra);
    $cade = str_replace("'", "", $caden);
    $cadena = str_replace("\"", "", $cade);

    //Ahora reemplazamos las letras
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );

    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena
    );

    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena
    );

    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena
    );

    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena
    );

    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );

    return $cadena;
}

function quitarComillas($texto)
{
    $textolimpio = "";
    $textoSinCdobles = str_replace('"', '', $texto);
    $textoSinCsimple = str_replace("'", '', $textoSinCdobles);

    return $textoSinCsimple;
}

function obtenerDiaSemana($fecha, $dianom = 0)
{

    $semana = array('Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom');
    $meses = array("", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
    $diaSemana = $semana[date('N', strtotime($fecha))];
    $fechaArr = explode("-", $fecha);
    $mesNumero = (string)(int)$fechaArr[1];
    if ($mesNumero > 0) {
        $dia = substr($fechaArr[2], 0, 2);
        $mes = $meses[$mesNumero];
        $ano = $fechaArr[0];

        if ($dianom == 2) {
            $cadena = $ano . " " . $mes;
        } else if ($dianom == 1) {
            $cadena = $diaSemana . ", " . $dia . " " . $mes . " " . $ano;
        } else if ($dianom == 0) {
            $cadena = $dia . " de " . $mes . " " . $ano;
        }
    } else {
        $cadena = " - ";
    }
    return $cadena;
}

function obtenerHoraFecha($fechareg)
{
    $horaArr = explode(":", $fechareg);
    $hora = (string)(int)substr($horaArr[0], 11, 13);
    $minuto = (string)(int)$horaArr[1];
    $segundo = (string)(int)$horaArr[2];

    if ($hora != "") {
        $mer = ($hora > 11) ? "P.M." : "A.M.";

        if ($hora <= 12) {
            if ($hora < 10) {
                $ceroH = "0" . $hora;
            } else {
                $ceroH = $hora;
            }
            if ($minuto < 10) {
                $ceroM = "0" . $minuto;
            } else {
                $ceroM = $minuto;
            }
            $cadena = $ceroH . ":" . $ceroM . " " . $mer;
        } else {
            if ($mer == "A.M.") {
                $formato12 = $hora;
            } else {
                $formato12 = $hora - 12;
            }

            if ($formato12 < 10) {
                $ceroH = "0" . $formato12;
            } else {
                $ceroH = $formato12;
            }
            if ($minuto < 10) {
                $ceroM = "0" . $minuto;
            } else {
                $ceroM = $minuto;
            }

            $cadena = $ceroH . ":" . $ceroM . " " . $mer;
        }
    } else {
        $cadena = "Sin formato";
    }

    return $cadena;
}

function versionarArchivo($archivo)
{
    return base_url . $archivo . '?v=' . md5_file(base_dir . $archivo);
}

function css()
{
    if ($_SERVER['HTTP_HOST'] === "localhost") {
        return '<link rel="stylesheet" href="' . versionarArchivo('css/main.css') . '" /> ';
    } else {
        $archivo = fopen(base_dir . "css/main.css", "r") or die("No se pudo abrir");
        $lectura = fread($archivo, filesize(base_dir . "css/main.css"));

        return "<style>" . str_replace("../img/", base_url . "img/", $lectura) . "</style>";

        fclose($archivo);
    }
}

// ACORTADOR DE TEXTOS
function custom_echo($x, $length = 156)
{
    return strlen($x) <= $length ? $x : substr($x, 0, $length) . '...';
}
