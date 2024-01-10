<?php
$dark = (get_filename_page() != "index.php") ? "dark" : "";
?>

<header class="<?php echo $dark; ?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8 col-lg-5 col-md-4">
        <div class="hamburger">
          <span id="openHam">&#9776;</span>
          <span id="closeHam">&#x2716;</span>
        </div>
        <nav class="navbar" id="navbar">
          <ul>
            <li>
              <a href="<?php echo base_url; ?>">Inicio</a>
            </li>
            <li>
              <a href="<?php echo base_url; ?>servicios/acero-galvanizado">Acero Galvanizado</a>
            </li>
            <li>
              <a href="<?php echo base_url; ?>proceso">Proceso</a>
            </li>
            <li>
              <a href="<?php echo base_url; ?>industrias/automotriz">Industrias</a>
            </li>
            <li>
              <a href="<?php echo base_url; ?>filosofia">Nosotros</a>
            </li>
            <li>
              <a href="<?php echo base_url; ?>blog">Blog</a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="d-none d-sm-block col-lg-2 col-md-3">
        <a href="<?php echo base_url; ?>" class="logo">
          <img src="<?php echo base_url; ?>img/logo.svg" alt="Logo Coantic Company">
        </a>
      </div>
      <div class="d-sm-none d-block col-4">
        <a href="<?php echo base_url; ?>" class="logo">
          <img src="<?php echo base_url; ?>img/coatinc-logo.png" alt="Logo Coantic Company" class="img-fluid logo_mobil">
        </a>
      </div>
      <div class="col-sm-5">
        <div class="information">
          <div class="phones">
            <i class="fa-solid fa-phone"></i>
            <a href="tel:+52664309534"><span>+</span>52 664 309534</a>
            <a href="https://wa.link/pt2weh" target="_BLANK"><span>+</span>52 664 1158473</a>
          </div>
          <a href="<?php echo base_url; ?>contacto" class="btn">VENTAS</a>
          <!-- <div class="languages">
            <a href="#">ES</a>
            <span> | </span>
            <a href="#">EN</a>
          </div> -->
        </div>
        <?php require_once '_whatsapp.php'; ?>
      </div>
    </div>
  </div>
</header>