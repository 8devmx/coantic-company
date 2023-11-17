<?php
require_once '_config.php';
$dark = (get_filename_page() != "index.php") ? "dark" : "";
?>

<header class="<?php echo $dark; ?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8 col-lg-5 col-md-4">
        <nav class="navbar">
          <ul>
            <li>
              <a href="<?php echo base_url; ?>">Inicio</a>
            </li>
            <li>
              <a href="<?php echo base_url; ?>productos-interna">Acero Galvanizado</a>
            </li>
            <!-- <li>
              <a href="#">Proceso</a>
            </li>
            <li>
              <a href="#">Industrias</a>
            </li>
            <li>
              <a href="#">Nosotros</a>
            </li>
            <li>
              <a href="#">Blog</a>
            </li> -->
          </ul>
        </nav>
      </div>
      <div class="d-none d-sm-block col-lg-2 col-md-3">
        <a href="<?php echo base_url; ?>" class="logo">
          <img src="img/logo.svg" alt="Logo Coantic Company">
        </a>
      </div>
      <div class="d-sm-none d-block col-4">
        <a href="<?php echo base_url; ?>" class="logo">
          <img src="img/coatinc-logo.png" alt="Logo Coantic Company" class="img-fluid logo_mobil">
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