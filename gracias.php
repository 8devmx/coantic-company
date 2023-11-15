<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Coantic Company</title>
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.14.0/css/flag-icons.min.css" />
  <link rel="stylesheet" href="js/slick/slick.css">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php require_once 'includes/_whatsapp.php'; ?>
  <div class="gracias">
    <div class="details">
      <a href="<?php echo base_url; ?>" class="gracias_logo d-none d-sm-block">
        <img src="img/logo-color.svg" alt="" class="img-fluid">
      </a>
      <a href="<?php echo base_url; ?>" class="gracias_logo d-sm-none d-block">
        <img src="img/favicon.png" alt="" class="img-fluid">
      </a>
      <h1 class="gracias_title">GRACIAS</h1>
      <p class="gracias_description">Tu mensaje se envió con éxito, en breve nos <br>pondremos en contacto contigo.</p>
      <a href="<?php echo base_url; ?>" class="btn">IR AL INICIO</a>
      <div class="bg_detail">
        <img src="img/bg_gracias.svg" alt="" class="img-fluid">
      </div>
    </div>
    <div class="image">
      <img src="img/gracias.jpg" alt="Gracias Coantic Company" class="img-fluid">
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
</body>

</html>