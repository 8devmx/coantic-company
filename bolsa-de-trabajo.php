<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php
  require_once 'includes/scripts.php';
  require_once 'includes/_functions.php';
  $vacantes = $db->select("vacantes", "*", ["activo_vac" => 1]);
  ?>

</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero_products_detail hero_bolsa">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1>BOLSA DE TRABAJO</h1>
          <p>Empleos</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container bolsa_posts">
    <div class="row">
      <div class="col-sm-12">
        <p class="bolsa_title"><strong>Vacantes disponibles.</strong></p>
      </div>
    </div>
    <div class="row">
      <?php
      foreach ($vacantes as $key => $vac) {
      ?>
        <div class="col-sm-6">
          <div class="bolsa_post">
            <h2><?php echo $vac['nom_vac']; ?></h2>
            <a href="<?php echo base_url; ?>vacantes/<?php echo $vac['url_vac']; ?>" class="btn">VER DETALLES</a>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/slick/slick.min.js"></script>
</body>

</html>