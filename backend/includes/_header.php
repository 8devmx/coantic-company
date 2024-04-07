<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="es"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title><?= $proyecto; ?> - Backend</title>
    <meta name="description" content="<?= $proyecto; ?>">
    <meta name="ROBOTS" content="INDEX, FOLLOW" />
    <meta name="author" content="Coatinc" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="geo.region" content="MX" />
    <meta name="geo.placename" content="Canc&uacute;n" />
    <meta name="geo.position" content="21.164057;-86.822498" />
    <meta name="ICBM" content="21.164057, -86.822498" />
    <meta name="DC.Language" content="es-MX">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="canonical" href="https://coatincmx.com/" />
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Coatinc",
            "logo": "https://www.coatincmx.com/img/logo.svg",
            "url": "https://www.coatincmx.com",
            "sameAs": [
                "https://twitter.com/coatincmx",
                "https://plus.google.com/+coatincmx",
                "https://www.facebook.com/coatincmx"
            ]
        }
    </script>
    <script>
        var $url = "<?= base_url; ?>",
            $urlsitio = "<?= basesite_url; ?>",
            $directorioGaleria = "<?= directorioGaleria; ?>";
        var seleccionadosChkSess = 0,
            totalOpcionesSess = 0;
        var module = {};
        var cadena_bullets = "<?= $cadena_bullets ?>";
    </script>
    <!-- Favicon -->
    <link href="<?= base_url; ?>img/favicon.png" rel="icon" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= base_url; ?>img/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url; ?>css/backend.css?t=<?= time(); ?>">
    <link rel="stylesheet" href="<?= base_url; ?>css/jquery-ui.css?t=<?= time(); ?>">
    <!-- <link rel="stylesheet" href="<?= base_url; ?>css/style_dropfile.css?t=<?= time(); ?>"> -->
    <!-- JS -->
    <script type="text/javascript">
        var $url = '<?= base_url ?>';
    </script>

    <?php
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    ?>
</head>

<body <?php if (isset($loginBack)) {
            echo 'class="login-back"';
        } ?>>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?php if ($_SESSION['session'] == "admin") { ?>

        <input type="hidden" name="tablaSeleccion" id="tablaSeleccion" value="<?= $valTablaSeleccion ?>">
        <input type="hidden" name="terminoSeleccion" id="terminoSeleccion" value="<?= $valTerminoSeleccion ?>">


        <header id="main-header">
            <div class="box-logo">
                <img src="<?= base_url; ?>img/logo.svg" alt="<?= $proyecto; ?>" class="main-logo">
            </div>
            <nav class="menu">
                <ul>
                    <?php
                    $modulos = new Modulos();
                    $modulos->menuModulos("modulos");
                    $modulos->menuModulos("configuracion");
                    ?>
                    <?PHP
                    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                    $seccion = ($sub != 0) ? $segments[count($segments) - 2] : $segments[count($segments) - 1];
                    $seccion = trim($seccion, '.php');
                    ?>
                </ul>
            </nav>

            <div class="session-activa">
                <p>
                    <span>Hola,</span> <strong class="perfilNombre"><?= $_SESSION['nombre'] ?> <i class="fa fa-angle-down" aria-hidden="true"></i></strong>
                </p>

                <ul class="submenu">
                    <li><a href="<?= base_url ?>logout">Cerrar Sesión <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </header>
    <?php } ?>


    <div class="right-col">
        <div class="contenido">