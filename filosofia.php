<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php require_once 'includes/scripts.php'; ?>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero_products_detail hero_filosofia">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1>ACERO GALVANIZADO EN MÉXICO</h1>
          <p>Filosofía The Coatinc Company</p>
        </div>
      </div>
    </div>
  </div>
  <div class="filosofia_intro">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-lg-1">
          <img src="img/coatinc-company-empresa-familiar.jpg" alt="The Coatinc Company es la empresa familiar más antigua de Alemania." class="img-fluid">
        </div>
        <div class="col-lg-4 offset-lg-1">
          <p class="mt-2">The Coatinc Company es la empresa familiar más antigua de Alemania. Fundada en 1502, desde entonces nuestro trabajo ha girado en torno al acero.</p>

          <p class="mt-4">The Coatinc Company llegó a México en el año 2015, ofreciendo a sus clientes una experiencia de más de 100 años en el Galvanizado por inmersión en caliente. Combinando así la presición y calidad alemana con el servicio y amabilidad mexicanos.</p>
        </div>
      </div>
      <div class="row industrias_filosofia">
        <div class="col-lg-5 offset-lg-1">
          <h3>INDUSTRIAS</h3>
          <p>Los ámbitos de aplicación son diversos: <strong>construcción metálica, partes para tráilers y tractocamiones, cerrajería, herrería, arte, piezas en serie, energías renovables y comercio de acero.</strong></p>
        </div>
      </div>
    </div>
    <div class="slider_filosofia">
      <div class="slides">
        <div>
          <a href="<?php echo base_url; ?>industrias/automotriz">
            <img src="img/transporte.png" class="img-fluid" alt="Transporte y Automotriz Coantic Company">
            <h5>Transporte
              <br>y Automotriz
            </h5>
          </a>
        </div>
        <div>
          <a href="<?php echo base_url; ?>industrias/construccion">
            <img src="img/construccion.png" class="img-fluid" alt="Construcción Coantic Company">
            <h5>Construcción</h5>
          </a>
        </div>
        <div>
          <a href="<?php echo base_url; ?>industrias/energias-renovables">
            <img src="img/energias-renovables.png" class="img-fluid" alt="Energías Renovables Coantic Company">
            <h5>Energías Renovables</h5>
          </a>
        </div>
        <div>
          <a href="<?php echo base_url; ?>industrias/comercio de acero">
            <img src="img/comercio.png" class="img-fluid" alt="Comercio de Acero Coantic Company">
            <h5>Comercio de Acero</h5>
          </a>
        </div>
        <div>
          <a href="<?php echo base_url; ?>industrias/herreria">
            <img src="img/herreria.png" class="img-fluid" alt="Herrería Coantic Company">
            <h5>Herrería</h5>
          </a>
        </div>
        <div>
          <a href="<?php echo base_url; ?>industrias/infraestructura">
            <img src="img/infraestructura.png" class="img-fluid" alt="Infraestructura Coantic Company">
            <h5>Infraestructura</h5>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="galvanizar">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <p class="text-center">Para galvanizar sus materiales, ponemos a su servicio la paila más grande del norte de México, que cuenta con las siguientes dimensiones:
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-lg-3 offset-lg-1 paila_details">
          <div class="paila_img">
            <img src="img/paila-height.svg" alt="">
          </div>
          <div>
            <h4>17.50 m</h4>
            <p>Largo</p>
          </div>
        </div>
        <div class="col-md-4 col-lg-3 offset-lg-1 paila_details">
          <div class="paila_img">
            <img src="img/paila-depth.svg" alt="">
          </div>
          <div>
            <h4>3.50 m</h4>
            <p>Profundidad</p>
          </div>
        </div>
        <div class="col-md-4 col-lg-3 offset-lg-1 paila_details">
          <div class="paila_img">
            <img src="img/paila-width.svg" alt="">
          </div>
          <div>
            <h4>1.40 m</h4>
            <p>Ancho</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container paila_caracteristicas">
    <div class="row">
      <div class="col-md-6 offset-lg-1 md-flex">
        <img src="img/paila-caracteristicas.png" alt="" class="img-fluid">
      </div>
      <div class="col-md-6 col-lg-4">
        <ul>
          <li>Esta paila nos permite galvanizar por doble inmersión <strong>piezas de hasta 19 metros de longitud.</strong></li>

          <li>Cumplimos los estándares de las normas <strong>ISO 1461, ASTM 123, NMX 004</strong> o la especificación que el cliente requiera.</li>

          <li>Nos consideramos una extensión del proceso de nuestros clientes y entendemos que asegurar la calidad de nuestros productos, tiempos de respuesta y entrega, atención personalizada y precio competitivo, hacen de nuestro servicio un diferenciador.</li>
        </ul>
      </div>
    </div>
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
        include 'includes/servicios.php';
        foreach ($services as $serv => $s) {
        ?>
          <div class="col-sm-4">
            <a href="<?php echo base_url . "servicios/" . $serv; ?>">
              <img src="img/<?php echo $s['preview']; ?>" alt="" class="img-fluid">
            </a>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/slick/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.slides').slick({
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