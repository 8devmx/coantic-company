<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php
  require_once 'includes/scripts.php';
  include_once 'includes/servicios.php';

  $service = array_key_exists($_GET["secc"], $services) ? $services[$_GET["secc"]] : header("Location:" . base_url);
  ?>
  <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=65b08713f771bd0012374668&product=image-share-buttons' async='async'></script>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero_products_detail" style="background-image: url(<?php echo base_url . 'img/' . $service['hero'] ?>);">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <h1><?php echo $service["title"] ?></h1>
          <p><?php echo $service["title"] ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="aleman_experience">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <img src="<?php echo base_url; ?>img/icon-aleman-experence.svg" alt="Acero Galvanizado Coantic Company" class="icon">
          <h2><?php echo $service["intro"]["title"] ?></h2>
          <?php
          for ($i = 0; $i < count($service["intro"]["paragraphs"]); $i++) {
          ?>
            <p><?php echo $service["intro"]["paragraphs"][$i]; ?></p>
          <?php
          }
          ?>
          <a href="<?php echo base_url; ?>contacto" class="btn">ME INTERESA</a>
        </div>
      </div>
    </div>
  </div>
  <div class="benefits_detail">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2><?php echo $service["benefits"]["title"] ?></h2>
          <?php
          if (gettype($service["benefits"]["text"]) == 'array') {
          ?>
            <ul>
              <?php
              for ($i = 0; $i < count($service["benefits"]["text"]); $i++) {
              ?>
                <li><?php echo $service["benefits"]["text"][$i]; ?></li>
              <?php
              }
              ?>
            </ul>
          <?php
          } else {
          ?>
            <p><?php echo $service["benefits"]["text"]; ?></p>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <img src="<?php echo base_url; ?>img/<?php echo $service['benefits']['image'] ?>" alt="<?php echo $service['benefits']['title'] ?> Coantic Company" class="benefits_detail_image">
  </div>
  <div class="container acero_galvanizado">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <h2><?php echo $service['about']['title'] ?></h2>
        <p><?php echo $service['about']['paragraph'] ?></p>
        <a href="<?php echo base_url; ?>proceso" class="btn">CONOCE NUESTRO PROCESO</a>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="application_materials">
          <h2><?php echo $service['caracteristics']['title'] ?></h2>
          <p><?php echo $service['caracteristics']['paragraph'] ?></p>
        </div>
      </div>
    </div>
  </div>
  <?php
  if (array_key_exists('slider', $service)) {
  ?>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="slide">
            <?php
            for ($i = 0; $i < count($service["slider"]); $i++) {
            ?>
              <img src="<?php echo base_url; ?>img/<?php echo $service['slider'][$i]; ?>" alt="">
            <?php
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
          for ($i = 0; $i < count($service["downloads"]["files"]); $i++) {
          ?>
            <a href="uploads/<?php echo $service['downloads']['files'][$i]['file']; ?>" target="_BLANK" class="requirement" download="<?php echo $service['downloads']['files'][$i]['file']; ?>">
              <span>
                <img src="<?php echo base_url; ?>img/pdf.svg" alt="">
                <?php echo $service['downloads']['files'][$i]['title']; ?></span>
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