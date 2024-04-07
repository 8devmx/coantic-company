<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php
  require_once 'includes/_functions.php';
  require_once 'includes/scripts.php';
  include_once 'includes/servicios.php';
  ?>
  <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=65b08713f771bd0012374668&product=image-share-buttons' async='async'></script>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero_ubicaciones">
    <h1 class="text-center">UBICACIONES</h1>
    <h2 class="text-center">The Coatinc Company: Líder internacional en soluciones de Galvanizado</h2>
    <div class="container hero_ubicaciones_details">
      <div class="row align-items-center">
        <div class="col-lg-5 offset-lg-1 col-md-6">
          <img src="img/mapa-ubicaciones.png" alt="" class="img-fluid">
        </div>
        <div class="col-lg-4 offset-lg-1 col-md-6">
          <p>Contamos con instalaciones de galvanización por inmersión en caliente ubicadas estratégicamente alrededor del mundo para atender diversas necesidades industriales.</p>

          <p>Nuestras plantas de galvanización están equipadas con tecnología de punta y cumplen con los más altos estándares de la industria, lo que garantiza una protección superior para sus productos metálicos contra la corrosión. Desde los bulliciosos paisajes urbanos hasta el sereno campo, nuestra empresa de recubrimientos ha establecido ubicaciones de galvanización en regiones clave, lo que hace que sea conveniente para las empresas de todo el mundo acceder a servicios de alta calidad.</p>

          <p>En The Coatinc Company ofrecemos soluciones integrales de galvanización que resisten la prueba del tiempo y los desafíos ambientales.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container ubicaciones">
    <div class="row text-center">
      <div class="col-sm-8 offset-sm-2">
        <img src="img/pin-gold.svg" alt="">
        <h3>UBICACIÓN MÉXICO</h3>
        <p>Andador Vecinal 3001, Colonia Otra No Especificada en el Catálogo, Valle Redondo, 22720 Tijuana, B.C.</p>
      </div>
      <div class="col-sm-12">
        <div class="maps">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3363.698984905477!2d-116.7568405!3d32.534185599999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d915809dd5d4c5%3A0x6074f9a05ad1f96f!2sCoatinc%20Mexico!5e0!3m2!1ses-419!2smx!4v1699224202534!5m2!1ses-419!2smx" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="sucursales">
      <div class="row">
        <div class="col-sm-12">
          <h3>THE COATINC COMPANY ALREDEDOR DEL MUNDO</h3>
        </div>
      </div>
      <div class="row">
        <div class="ubicaciones_slider">
          <div class="col-xl-3 col-md-6">
            <div class="sucursal">
              <div class="title">
                <h4>ALEMANIA</h4>
              </div>
              <p>Bochum / D <br>
                Groß-Rohrheim / D <br>
                Peine / D <br>
                Saarlouis – Lisdorfer Berg / D <br>
                Siegen / D <br>
                Siegen – PreGa / D <br>
                Wildeshausen / D <br>
                Würzburg / D</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="sucursal">
              <div class="title">
                <h4>PAÍSES BAJOS</h4>
              </div>
              <p>Alblasserdam / NL <br>
                Amsterdam / NL <br>
                Barneveld / NL <br>
                De Meern / NL <br>
                Groningen / NL <br>
                Mook / NL <br>
                Mook – PreGa / NL <br>
                Roermond / NL <br>
                Scherpenzeel / NL</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="sucursal">
              <div class="title">
                <h4>BÉGICA</h4>
              </div>
              <p>Ninove/B <br>
                Ninove – NinoCoat / B <br>
                Genk/B</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="sucursal">
              <div class="title">
                <h4>REPÚBLICA CHECA</h4>
              </div>
              <p>Decin/ CZ <br>
                Ostrava-Kuncice/ CZ <br>
                Roudnice/ CZ</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="sucursal">
              <div class="title">
                <h4>TURQUÍA</h4>
              </div>
              <p>Corlu / TR <br>
                Gebze/TR <br>
                Esmirna / TR
              </p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="sucursal">
              <div class="title">
                <h4>ESLOVAQUIA</h4>
              </div>
              <p>Malacky / SK</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="sucursal">
              <div class="title">
                <h4>ESTADOS UNIDOS</h4>
              </div>
              <p>San Diego</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="sucursal">
              <div class="title">
                <h4>MÉXICO</h4>
              </div>
              <p>Tijuana</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 ubicaciones_action">
        <a href="<?php echo base_url . "contacto"; ?>" class="btn">CONTÁCTANOS</a>
      </div>
    </div>
  </div>
  <div class="container timeline_botonera">
    <div class="row button_group">
      <?php include 'includes/nosotros.php'; ?>
    </div>
  </div>
  <div class="nuestros_servicios">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>CONOCE NUESTROS SERVICIOS</h2>
        </div>
        <?php
        $servicios = $db->select("servicios", "*", [
          "activo_ser" => 1
        ]);
        foreach ($servicios as $key => $servicio) {
          $service = array_key_exists($servicio['url_ser'], $services) ? $services[$servicio['url_ser']] : [];
        ?>

          <div class="col-sm-4 service_hover">
            <a href="<?php echo base_url . "servicios/" . $servicio['url_ser']; ?>">
              <img src="img/<?php echo $service['preview'] ?>" alt="" class="img-fluid">
            </a>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 blog_interna_share_this_dark">
          <p class="text-center">Comparte esta página:</p>
          <div class="sharethis-inline-share-buttons"></div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/slick/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.ubicaciones_slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        infinite: true,
        slidesToShow: 4,
        SlidesToScroll: 1,
        responsive: [{
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }
        ]
      })
    })
  </script>
</body>

</html>