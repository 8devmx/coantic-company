<?php
$dark = (get_filename_page() != "index.php") ? "dark" : "";

require_once '_functions.php';
?>

<header class="<?php echo $dark; ?>">
  <div class="container-fluid">
    <div class="row header-container">
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
              <a href="#">Servicios</a>
              <ul>
                <?php
                $servicios = $db->select("servicios", "*", [
                  "activo_ser" => 1
                ]);
                foreach ($servicios as $key => $s) {
                ?>
                  <li>
                    <a href="<?php echo base_url . "servicios/" . $s['url_ser']; ?>"><?php echo  $s['titulo_ser'] ?></a>
                  </li>

                <?php
                }
                ?>
              </ul>
            </li>
            <li>
              <a href="<?php echo base_url; ?>proceso">Proceso</a>
            </li>
            <li>
              <a href="#">Industrias</a>
              <ul>
                <?php
                $industrias = $db->select("industrias", "*", [
                  "activo_ind" => 1
                ]);
                foreach ($industrias as $key => $industria) {
                ?>
                  <li>
                    <a href="<?php echo base_url . "industrias/" . $industria['url_ind']; ?>"><?php echo  $industria['titulo_ind'] ?></a>
                  </li>

                <?php
                }
                ?>
              </ul>
            </li>
            <li>
              <a href="#">Nosotros</a>
              <ul>
                <li><a href="<?php echo base_url; ?>historia">Historia</a></li>
                <li><a href="<?php echo base_url; ?>filosofia">Filosofía</a></li>
                <li><a href="<?php echo base_url; ?>ubicaciones">Ubicaciones</a></li>
                <li><a href="<?php echo base_url; ?>sustentabilidad">Sustentabilidad</a></li>
              </ul>
            </li>
            <?php
            $blog_count = $db->count("blog", ["activo_blog" => 1]);
            if ($blog_count > 0) {
            ?>
              <li>
                <a href="<?php echo base_url; ?>blog">Blog</a>
              </li>
            <?php } ?>
          </ul>
        </nav>
      </div>
      <div class="d-none d-sm-block col-lg-2 col-md-3">
        <a href="<?php echo base_url; ?>" class="logo">
          <img src="<?php echo base_url; ?>img/logo.svg" alt="Logo Coatinc Company">
        </a>
      </div>
      <div class="d-sm-none d-block col-4">
        <a href="<?php echo base_url; ?>" class="logo">
          <img src="<?php echo base_url; ?>img/coatinc-logo.png" alt="Logo Coatinc Company" class="img-fluid logo_mobil">
        </a>
      </div>
      <div class="col-sm-5">
        <div class="information">
          <div class="phones">
            <i class="fa-solid fa-phone"></i>
            <a href="tel:+526643095346"><span>+</span>52 664 3095346</a>
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