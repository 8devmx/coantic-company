<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php require_once 'includes/scripts.php'; ?>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="container-fluid blog_back">
    <div class="row">
      <div class="col-sm-12">
        <a href="blog">Todos los empleos</a>
      </div>
    </div>
  </div>
  <div class="container bolsa_interna_post">
    <div class="row">
      <div class="col-lg-12 col-md-10 offset-md-1 offset-lg-0">
        <h1>Éste es el H1 - Nombre de la vacante</h1>
        <h5>Tiempo completo</h5>
        <h3>Descripción del puesto</h3>
        <p>Dictum turpis consectetur facilisis curae purus blandit potenti amet a ante a ullamcorper cubilia nisl. Pharetra parturient fusce suspendisse in eros aliquam consectetur a suspendisse ultricies aliquam a suspendisse aptent fringilla pretium hac eleifend parturient venenatis. Et vel nec interdum eget tempus a ullamcorper sapien sed torquent lobortis lacus at vivamus.</p>
        <h4>Responsabilidades</h4>
        <p>· Dictum turpis consectetur facilisis curae purus blandit potenti amet a ante a ullamcorper cubilia nisl.
        </p>
        <ul>
          <li>Pharetra parturient fusce suspendisse in eros aliquam consectetur a suspendisse</li>
          <li>Ultricies aliquam a suspendisse aptent fringilla pretium hac eleifend parturient venenatis.</li>
          <li>Et vel nec interdum eget tempus a ullamcorper sapien sed torquent lobortis lacus at vivamus.</li>
        </ul>
        <h4>Requisitos</h4>
        <p>· Dictum turpis consectetur facilisis curae purus blandit potenti amet a ante a ullamcorper cubilia nisl.
        </p>
        <ul>
          <li>Pharetra parturient fusce suspendisse in eros aliquam consectetur a suspendisse</li>
          <li>Ultricies aliquam a suspendisse aptent fringilla pretium hac eleifend parturient venenatis.</li>
          <li>Et vel nec interdum eget tempus a ullamcorper sapien sed torquent lobortis lacus at vivamus.</li>
        </ul>
        <a href="#" class="btn">POSTULARME</a>
      </div>
    </div>
  </div>
  <div class="bolsa_postularme">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3">
          <h4>Postularme para este empleo</h4>
          <h5>Envíanos tus datos y pronto te contactaremos.</h5>
          <form action="#">
            <input type="text" placeholder="Nombre:*">
            <input type="text" placeholder="Teléfono:*">
            <input type="file">
            <button class="btn">ENVIAR DATOS</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/slick/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.slider_blog_interna').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        infinite: true,
        slidesToShow: 2,
        SlidesToScroll: 1,
        responsive: [{
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }
        ]
      })
    })
  </script>
</body>

</html>