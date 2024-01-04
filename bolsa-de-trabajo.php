<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php require_once 'includes/scripts.php'; ?>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero_products_detail hero_bolsa">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1>BOLSA DE TRABAJO</h1>
          <p>Empleos en Baja California</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container bolsa_posts">
    <div class="row">
      <div class="col-sm-12">
        <p class="bolsa_title"><strong>Vacantes disponibles en Tijuana.</strong></p>
      </div>
    </div>
    <div class="row">
      <?php
      for ($i = 0; $i < 8; $i++) {
      ?>
        <div class="col-sm-6">
          <div class="bolsa_post">
            <h2>Éste es el H1 - Nombre de la Vacante</h2>
            <a href="bolsa-de-trabajo-interna" class="btn">VER DETALLES</a>
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