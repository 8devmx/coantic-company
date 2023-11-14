<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Coantic Company</title>
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="js/slick/slick.css">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero">
    <video class="fillWidth" src="img/video-home.mp4" autoplay="" muted="" loop="">
      Your browser does not support the video tag1.
    </video>
    <div class="hero_description">
      <p class="letter_spacing">EXPERTOS EN SERVICIOS DE</p>
      <h1>GALVANIZADO DE ACERO
        <strong>POR INMERSIÓN EN CALIENTE</strong>
      </h1>
      <p>Conoce la Calidad Alemana en Servicios de Galvanizado en México</p>
      <a href="<?php echo base_url; ?>contacto" class="btn mt-35">CONTÁCTANOS</a>
    </div>
    <div class="services">
      <div class="service">
        <a href="<?php echo base_url; ?>productos-interna">
          <img src="img/icon-galvanizado.svg" alt="Galvanizado Coantic Company" class="service_icon">
          <div class="service_title">
            <h4>Galvanizado <br>por inmersión en caliente</h4>
            <img src="img/icon-arrow.svg" alt="Arrow Coantic Company">
          </div>
        </a>
      </div>
      <div class="service">
        <a href="#">
          <img src="img/icon-importacion.svg" alt="Importación Coantic Company" class="service_icon">
          <div class="service_title">
            <h4>Importación <br>y exportación</h4>
            <img src="img/icon-arrow.svg" alt="Arrow Coantic Company">
          </div>
        </a>
      </div>
      <div class="service">
        <a href="#">
          <img src="img/icon-logistica.svg" alt="Logística Coantic Company" class="service_icon">
          <div class="service_title">
            <h4>Soluciones <br>logísticas</h4>
            <img src="img/icon-arrow.svg" alt="Arrow Coantic Company">
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="benefits">
    <div class="container">
      <div class="row">
        <div class="col">
          <h3>GALVANIZADO DE ACERO POR INMERSIÓN EN CALIENTE</h3>
          <p class="benefits_subtitle"><strong>El Galvanizado por Inmersión en Caliente es un proceso de recubrimiento
              del acero esencial para
              garantizar la protección
              y durabilidad del acero</strong></p>
          <p class="benefits_description">Ubicados en Tijuana Baja California, The Coatinc Company llegó a México desde
            Alemania para ofrecer a sus
            clientes la
            mejor protección contra la corrosión a través del galvanizado <br>por inmersión en caliente.</p>
          <a href="<?php echo base_url; ?>productos-interna" class="btn">VER BENEFICIOS</a>
        </div>
      </div>
    </div>
  </div>
  <div class="paila">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="paila_slider">
            <img src="img/paila-principal-1.png" alt="Paila más grande Coantic" class="paila_principal">
            <img src="img/paila-principal-2.png" alt="Paila más grande Coantic" class="paila_principal">
            <img src="img/paila-principal-3.png" alt="Paila más grande Coantic" class="paila_principal">
            <img src="img/paila-principal-4.png" alt="Paila más grande Coantic" class="paila_principal">
          </div>
        </div>
        <div class="col-sm-6">
          <p class="paila_description">Contamos con la paila más grande del noroeste de México
            <br>que permite inmersiones de piezas de <strong>hasta 23 metros de longitud por doble inmersión.</strong>
          </p>
          <div class="row">
            <div class="col-sm-4 paila_details">
              <div class="paila_img">
                <img src="img/paila-height.svg" alt="">
              </div>
              <h4>17.50 m</h4>
              <p>Largo</p>
            </div>
            <div class="col-sm-4 paila_details">
              <div class="paila_img">
                <img src="img/paila-depth.svg" alt="">
              </div>
              <h4>3.50 m</h4>
              <p>Profundidad</p>
            </div>
            <div class="col-sm-4 paila_details">
              <div class="paila_img">
                <img src="img/paila-width.svg" alt="">
              </div>
              <h4>1.40 m</h4>
              <p>Ancho</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="process">
    <div class="container">
      <div class="row">
        <div class="col-10 offset-1">
          <h4>PROCESO</h4>
          <p class="process_description">El proceso de Galvanizado es una técnica que se usa para proteger el acero de
            la corrosión. Consiste en la
            inmersión de
            piezas de acero en zinc <br>fundido para crear un recubrimiento que las protege potenciando su fortaleza
            mecánica a los
            golpes y a la abrasión.</p>
        </div>
      </div>
    </div>
    <div class="process_steps">
      <div class="process_step">
        <img src="img/process-1.png" alt="Proceso de Galvanizado Coantic Company" class="img-fluid">
        <div class="process_step_number">
          <strong>1</strong>
          <p>Inspección de Material</p>
        </div>
      </div>
      <div class="process_step">
        <img src="img/process-2.png" alt="Proceso de Galvanizado Coantic Company" class="img-fluid">
        <div class="process_step_number">
          <strong>2</strong>
          <p>Armado</p>
        </div>
      </div>
      <div class="process_step">
        <img src="img/process-3.png" alt="Proceso de Galvanizado Coantic Company" class="img-fluid">
        <div class="process_step_number">
          <strong>3</strong>
          <p>Proceso químico</p>
        </div>
      </div>
      <div class="process_step">
        <img src="img/process-4.png" alt="Proceso de Galvanizado Coantic Company" class="img-fluid">
        <div class="process_step_number">
          <strong>4</strong>
          <p>Inmersión en Zinc</p>
        </div>
      </div>
      <div class="process_step">
        <img src="img/process-5.png" alt="Proceso de Galvanizado Coantic Company" class="img-fluid">
        <div class="process_step_number">
          <strong>5</strong>
          <p>Acabado</p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-2 offset-5">
          <a href="<?php echo base_url; ?>productos-interna" class="btn">VER PROCESO A DETALLE</a>
        </div>
      </div>
    </div>
  </div>
  <div class="company">
    <div class="container">
      <div class="row">
        <div class="col-4">
          <h4>LA EMPRESA</h4>
          <p class="company_description">The Coatinc Company México es una empresa comprometida con la calidad y la
            innovación en el campo del
            galvanizado de
            acero por inmersión en caliente. Nuestra experiencia y tecnología nos permiten ofrecer soluciones
            excepcionales para
            diversos sectores.</p>
          <a href="#" class="btn">NUESTRA FILOSOFÍA</a>
        </div>
      </div>
    </div>
    <div class="company_image">
      <img src="img/company_image.jpg" alt="" class="img-fluid">
    </div>
  </div>
  <div class="sustainability">
    <div class="sustainability_image">
      <img src="img/empresa-sustentable.svg" alt="Empresa Sustentable Coantic Company" class="logo_infinite">
      <img src="img/sustentable-image.png" alt="Empresa Sustentable Coantic Company">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-7 offset-5">
          <h4>SUSTENTABILIDAD EN SERVICIOS DE GALVANIZADO</h4>
          <p>Nos enorgullece ser líderes en galvanización, nuestra experiencia nos respalda, y nuestra pasión por la
            excelencia se
            refleja en cada proyecto, nos esforzamos por ofrecer un proceso sostenible, libre de disolventes, aceites y
            micro
            plásticos, además de que la protección contra la corrosión que proporciona el galvanizado aumenta la vida
            útil del
            acero, reduciendo costos y minimizando el consumo de recursos.</p>

          <p>En este sentido somos líderes en Servicios de Galvanizado en México; en razón a que tanto el proceso de
            galvanización,
            como los productos terminados no solo es eficiente, sino también <strong>sostenible</strong>, su protección
            contra la
            corrosión garantiza
            durabilidad y robustez, disminuyendo la necesidad de mantenimiento, reparación o reemplazo.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="interest">
          <div class="row">
            <div class="col-8 offset-4">
              <p>¿Estás interesado en alguno de nuestros servicios de Acero Galvanizado?</p>
              <a href="<?php echo base_url; ?>contacto" class="btn">CONTÁCTANOS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="sectors">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h4>SECTORES</h4>
          <p>Este proceso de recubrimiento del acero, se aplica con éxito en sectores como:</p>
        </div>
      </div>
      <div class="row">
        <div class="col-2">
          <img src="img/transporte.png" alt="Transporte y Automotriz Coantic Company">
          <h5 class="sectors_title">Transporte
            <br>y Automotriz
          </h5>
        </div>
        <div class="col-2">
          <img src="img/construccion.png" alt="Construcción Coantic Company">
          <h5 class="sectors_title">Construcción</h5>
        </div>
        <div class="col-2">
          <img src="img/energias-renovables.png" alt="Energías Renovables Coantic Company">
          <h5 class="sectors_title">Energías Renovables</h5>
        </div>
        <div class="col-2">
          <img src="img/comercio.png" alt="Comercio de Acero Coantic Company">
          <h5 class="sectors_title">Comercio de Acero</h5>
        </div>
        <div class="col-2">
          <img src="img/herreria.png" alt="Herrería Coantic Company">
          <h5 class="sectors_title">Herrería</h5>
        </div>
        <div class="col-2">
          <img src="img/infraestructura.png" alt="Infraestructura Coantic Company">
          <h5 class="sectors_title">Infraestructura</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="other_services">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h4>OTROS SERVICIOS</h4>
          <p>Además de nuestros servicios de galvanizado, ofrecemos soluciones complementarias.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-6 other_service">
          <img src="img/importacion.png" alt="Importación y exportación Coantic Company">
          <h5>Importación y exportación</h5>
        </div>
        <div class="col-6 other_service">
          <img src="img/soluciones-logisticas.png" alt="Soluciones logísticas Coantic Company">
          <h5>Soluciones logísticas</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="location">
    <div class="container">
      <div class="maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3363.698984905477!2d-116.7568405!3d32.534185599999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d915809dd5d4c5%3A0x6074f9a05ad1f96f!2sCoatinc%20Mexico!5e0!3m2!1ses-419!2smx!4v1699224202534!5m2!1ses-419!2smx" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="row">
        <div class="col-4 offset-8">
          <img src="img/mexico.svg" alt="">
          <h4 class="location_title">UBICACIÓN</h4>
          <p class="location_state">Visítanos en nuestras instalaciones en Tijuana,
            <br><strong>Baja California.</strong>
          </p>
          <img src="img/pin.svg" alt="" class="location_pin">
          <p class="location_address">Andador Vecinal 3001, Colonia Otra No Especificada en el Catálogo, Valle Redondo,
            22720 Tijuana, B.C.</p>
          <p class="location_phone">
            <i class="fa-solid fa-phone">+</i> 52 664 309534
          </p>
          <p class="location_phone">
            <i class="fa-solid fa-phone">+</i> 52 664 1158473
          </p>
          <a href="<?php echo base_url; ?>contacto" class="btn">CONTÁCTANOS</a>
        </div>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/slick/slick.min.js"></script>
  <script src="js/index.js"></script>
</body>

</html>