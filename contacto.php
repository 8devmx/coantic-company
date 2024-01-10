<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php require_once 'includes/scripts.php'; ?>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero_contacto">
    <h1>CONTÁCTANOS</h1>
    <p>Escríbenos para obtener asesoría personalizada</p>
    <div class="select">
      <span class="fi fi-mx" id="country_flag""></span>
      <select name=" country" id="country">
        <option value="mx">México</option>
        <option value="us">Estados Unidos</option>
        </select>
    </div>
    <div class="phones">
      <p class="phone">
        <i class="fa-solid fa-phone">+</i> <span id="tel_country">52 664 3095346</span>
      </p>
      <p class="phone">
        <i>+</i> <span id="cel_country">52 664 1158473</span>
      </p>
    </div>
  </div>
  <div class="form_contacto formulario-informacion-contact">
    <div class="form_image">
      <img src="img/form_image.png" alt="">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-5 offset-sm-7">
          <p>Déjanos tus datos, pronto nos pondremos en contacto contigo.</p>
          <div class="row">
            <div class="col-6">
              <input type="text" placeholder="Nombre" id="nombre" name="nombre">
            </div>
            <div class="col-6">
              <input type="text" placeholder="Apellido" id="apellido" name="apellido">
            </div>
            <div class="col-6">
              <input type="text" placeholder="Empresa" id="empresa" name="empresa">
            </div>
            <div class="col-6">
              <input type="text" placeholder="Teléfono" id="telefono" name="telefono" class="telefono">
            </div>
            <div class="col-6">
              <input type="text" placeholder="Email" id="email" name="email" class="correo">
            </div>
            <div class="col-6">
              <select name="interes" id="interes">
                <option value="Acero galvanizado">Acero galvanizado</option>
                <option value="Importación y exportación">Importación y exportación</option>
                <option value="Fletes">Fletes</option>
              </select>
            </div>
            <div class="col-12">
              <input type="text" placeholder="Mensaje" id="mensaje" name="mensaje" class="norequired">
            </div>
            <div class="col-12">
              <div class="captcha"></div>
            </div>
            <div class="col-12">
              <input type="button" value="ENVIAR" class="btn" id="frm_button" data-source="contact">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="location_contacto">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h3>
            <img src="img/pin.svg" alt="">
            VISÍTANOS EN MÉXICO
          </h3>
        </div>
        <div class="col-sm-9">
          <p>Andador Vecinal 3001, Colonia Otra No Especificada en el Catálogo, Valle Redondo, 22720 Tijuana, B.C.</p>
        </div>
        <div class="col-sm-3">
          <!-- <a href="#" class="btn float-end">VER OTROS PAÍSES</a> -->
        </div>
      </div>
      <div class="row">
        <div class="maps">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3363.698984905477!2d-116.7568405!3d32.534185599999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d915809dd5d4c5%3A0x6074f9a05ad1f96f!2sCoatinc%20Mexico!5e0!3m2!1ses-419!2smx!4v1699224202534!5m2!1ses-419!2smx" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
    const $url = '<?php echo base_url; ?>'
    const countries = {
      "mx": {
        flag: "fi-mx",
        tel: "52 664 3095346",
        cel: "52 664 1158473",
        email: "ernesto.tovar@coatinc.com"
      },
      "us": {
        flag: "fi-us",
        tel: "1 619 7516830",
        cel: "",
        email: "p.mcsweeney@coatinc.com"
      }
    }
    $(document).ready(() => {
      $("#country").change(() => {
        const country = $("#country").val()
        $("#country_flag").removeClass(countries["mx"].flag).removeClass(countries["us"].flag).addClass(countries[country].flag)
        $("#tel_country").text(countries[country].tel)
        if (countries[country].cel == "") {
          $("#cel_country").parent().hide()
        } else {
          $("#cel_country").parent().show()
          $("#cel_country").text(countries[country].cel)
        }
      })
    })
  </script>
  <script>
    function gtag_report_conversion(url) {
      var callback = function() {
        if (typeof(url) != 'undefined') {
          window.location = url;
        }
      };
      gtag('event', 'conversion', {
        'send_to': 'AW-11420443752/9D1ACProi_kYEOjI2MUq',
        'event_callback': callback
      });
      return false;
    }
  </script>
  <script src="js/form.js"></script>
</body>

</html>