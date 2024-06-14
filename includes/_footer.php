<footer>
  <div class="prefooter">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2">
          <h3>SERVICIOS</h3>
          <ul>
            <?php
            $servicios = $db->select("servicios", "*", [
              "activo_ser" => 1
            ]);
            foreach ($servicios as $key => $servicio) {
            ?>
              <li>
                <a href=" <?php echo base_url . "servicios/" . $servicio['url_ser']; ?>"><?php echo $servicio['titulo_ser']; ?></a>
              </li>

            <?php
            }
            ?>
          </ul>
        </div>
        <div class="col-sm-4">
          <div class="row">
            <div class="col">
              <h3>INDUSTRIAS</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <ul class="two-columns">
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
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="row">
            <div class="col">
              <h3>NOSOTROS</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <ul>
                <li><a href="<?php echo base_url; ?>historia">Historia</a></li>
                <li><a href="<?php echo base_url; ?>filosofia">Filosofía</a></li>
                <li><a href="<?php echo base_url; ?>sustentabilidad">Responsabilidad</a></li>
              </ul>
            </div>
            <div class="col-sm-6">
              <ul>
                <li><a href="<?php echo base_url; ?>proceso">Nuestro proceso</a></li>
                <li><a href="<?php echo base_url; ?>sustentabilidad">Sustentabilidad</a></li>
                <li><a href="<?php echo base_url; ?>ubicaciones">Ubicaciones</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-2 d-md-none d-lg-block">
          <img src="<?php echo base_url; ?>img/500-years.png" class="img_footer float-end" alt="500 Years Family Business">
          <div class="clear"></div>
          <div class="downloads">
            <a href="<?php echo base_url; ?>servicios/acero-galvanizado#requirements">Descargas</a>
            <a href="https://www.linkedin.com/showcase/coatinc-united-states-inc/" target="_BLANK" class="linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="postfooter">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-lg-5 col-md-4">
          <p>TheCoatincCompany® México. Todos los Derechos Reservados <?php echo date("Y"); ?>.</p>
        </div>
        <div class="col-lg-2 col-md-3">
          <a href="<?php echo base_url; ?>" class="logo">
            <img src="<?php echo base_url; ?>img/logo.svg" alt="Logo Coatinc Company">
          </a>
        </div>
        <div class="col-lg-5 col-md-5">
          <div class="information_footer">
            <div class="menu_footer">
              <?php
              $vacantes_count = $db->count("vacantes", ["activo_vac" => 1]);
              if ($vacantes_count > 0) {
              ?>
                <a href="<?php echo base_url; ?>bolsa-de-trabajo">Bolsa de trabajo</a>
                <span> | </span>
              <?php
              }
              ?>
              <a href="<?php echo base_url; ?>aviso-de-privacidad">Aviso de Privacidad</a>
            </div>
            <a href="<?php echo base_url; ?>contacto" class="btn">CONTACTO</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<script>
  let openHam = document.querySelector('#openHam');
  let closeHam = document.querySelector('#closeHam');
  let navigationItems = document.querySelector('#navbar');

  const hamburgerEvent = (navigation, close, open) => {
    navigationItems.style.display = navigation;
    closeHam.style.display = close;
    openHam.style.display = open;
  }

  openHam.addEventListener('click', () => hamburgerEvent("flex", "block", "none"));
  closeHam.addEventListener('click', () => hamburgerEvent("none", "none", "block"));
</script>