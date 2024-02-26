<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php
  require_once 'includes/_functions.php';
  require_once 'includes/scripts.php';
  include_once 'includes/servicios.php';

  $service = array_key_exists($_GET["secc"], $services) ? $services[$_GET["secc"]] : [];
  $servicio = $db->get("servicios", "*", [
    "AND" => [
      "url_ser" => $_GET['secc'],
      "activo_ser" => 1,
    ]
  ]);
  ?>
  <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=65b08713f771bd0012374668&product=image-share-buttons' async='async'></script>
</head>

<body>
  <?php
  require_once 'includes/_header.php'; ?>
  <div class="hero_products_detail" style="background-image: url(<?php echo base_url . 'uploads/servicios/' . $servicio['hero_ser'] ?>);">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <h1><?php echo $servicio["titulo_ser"] ?></h1>
          <p><?php echo $servicio["subtitulo_ser"] ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="aleman_experience">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <img src="<?php echo base_url; ?>img/icon-aleman-experence.svg" alt="Acero Galvanizado Coatinc Company" class="icon">
          <?php echo $servicio["descripcion_ser"]; ?>
          <a href="<?php echo base_url; ?>contacto" class="btn">ME INTERESA</a>
        </div>
      </div>
    </div>
  </div>
  <div class="benefits_detail">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <?php echo $servicio["beneficios_ser"]; ?>
        </div>
      </div>
    </div>
    <img src="<?php echo base_url; ?>uploads/servicios/<?php echo $servicio['beneficios_imagen_ser']; ?>" alt="Coatinc Company" class="benefits_detail_image">
  </div>
  <div class="container acero_galvanizado">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <?php echo $servicio["acerca_ser"]; ?>
        <a href="<?php echo base_url; ?>proceso" class="btn">CONOCE NUESTRO PROCESO</a>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="application_materials">
          <?php echo $servicio["caracteristicas_ser"]; ?>
        </div>
      </div>
    </div>
  </div>
  <?php
  if ($servicio["slider_ser"] != "**") {
    $slider = explode("**", $servicio["slider_ser"]);
  ?>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="slide">
            <?php
            for ($i = 0; $i < count($slider); $i++) {
              if ($slider[$i] != "") {
            ?>
                <img src="<?php echo base_url; ?>uploads/servicios/<?php echo $slider[$i]; ?>" alt="">
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="requirements" id="requirements">
    <div class=" requirements_image">
      <img src="<?php echo base_url; ?>img/<?php echo $service['downloads']['image'] ?>" alt="">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-lg-7 col-md-6 offset-md-6">
          <h2>REQUISITOS</h2>
          <p>Descarga nuestros brochures para conocer más</p>

          <?php
          $descargas = json_decode($servicio["descargas_ser"]);
          foreach ($descargas as $key => $descarga) {

          ?>
            <a href="uploads/servicios/<?php echo $descarga->url; ?>" target="_BLANK" class="requirement" download="<?php echo $descarga->name; ?>">
              <span>
                <img src="<?php echo base_url; ?>img/pdf.svg" alt="">
                <?php echo $descarga->title; ?></span>
              <img src="<?php echo base_url; ?>img/gold-arrow.svg" alt="">
            </a>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
  if (array_key_exists('slider', $service)) {
  ?>
    <div class="container entrega_express">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <img src="<?php echo base_url; ?>img/entrega-express.svg" alt="">
          <h2><?php echo $service['extras']['title'] ?></h2>
          <p><?php echo $service['extras']['text'] ?></p>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="interest">
          <div class="row">
            <div class="col-sm-8 offset-sm-4">
              <p>¿Estás interesado en alguno de nuestros servicios de Acero Galvanizado?</p>
              <a href="<?php echo base_url; ?>contacto" class="btn">CONTÁCTANOS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 blog_interna_share_this">
        <p class="text-center">Comparte esta página:</p>
        <div class="sharethis-inline-share-buttons"></div>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="<?php echo base_url; ?>js/slick/slick.min.js"></script>
  <script src="<?php echo base_url; ?>js/productos-interna.js"></script>
</body>

</html>