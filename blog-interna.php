<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php
  require_once 'includes/_functions.php';
  require_once 'includes/scripts.php';
  $post = $db->get("blog", "*", [
    "AND" => [
      "url_blog" => $_GET['secc'],
      "activo_blog" => 1,
    ]
  ]);
  ?>
  <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=65b08713f771bd0012374668&product=image-share-buttons' async='async'></script>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="container-fluid blog_back">
    <div class="row">
      <div class="col-sm-12">
        <a href="<?php echo base_url; ?>blog">Todos los artículos</a>
      </div>
    </div>
  </div>
  <div class="container blog_post_interna">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <h1><?php echo $post['nom_blog']; ?></h1>
        <img src="<?php echo base_url; ?>uploads/blog/<?php echo $post['foto_blog']; ?>" class="img-fluid">
        <h2><?php echo $post['texto1_blog']; ?></h2>
        <?php echo $post['desc_blog']; ?>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="slider_blog_interna">
          <?php
          $slider = explode('**', $post['galeria_blog']);
          ?>
          <?php
          for ($i = 0; $i < count($slider); $i++) {
            if ($slider[$i] != "") {
          ?>
              <img src="<?php echo base_url; ?>uploads/blog/<?php echo $slider[$i]; ?>" class="img-fluid">
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 blog_interna_share_this">
        <p class="text-center">Comparte esté artículo:</p>
        <div class="sharethis-inline-share-buttons"></div>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="<?php echo base_url; ?>js/slick/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.slider_blog_interna').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: true,
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