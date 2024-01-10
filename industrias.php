<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php
  require_once 'includes/scripts.php';
  include_once 'includes/industries.php';
  $industry = array_key_exists($_GET["secc"], $industries) ? $industries[$_GET["secc"]] : header("Location:" . base_url);
  ?>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero_industries">
    <div class="hero_title">
      <h1><?php echo $industry["hero"]["title"]; ?></h1>
      <p><?php echo $industry["hero"]["subtitle"]; ?></p>
    </div>
    <div class="hero_industries_slider">
      <?php
      for ($i = 0; $i < count($industry["hero"]["slider"]); $i++) {
      ?>
        <div>
          <img src="<?php echo base_url . "img/" . $industry["hero"]["slider"][$i]; ?>" class="img-fluid">
        </div>
      <?php
      }
      ?>
    </div>
  </div>
  <div class="industries_benefits">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h2><?php echo $industry["benefits"]["title"]; ?></h2>
          <p><?php echo $industry["benefits"]["text"]; ?></p>
        </div>
      </div>
      <div class="row industries_benefits_wrapper">
        <?php
        foreach ($industry["benefits"]["items"] as $key => $benefit) {
        ?>
          <div class="col-sm-6 industries_benefit">
            <div class="industries_benefits_icon">
              <img src="<?php echo base_url . "img/" . $benefit['icon']; ?>" class="img-fluid">
            </div>
            <div class="industries_benefits_text">
              <h3><?php echo $benefit['title']; ?></h3>
              <p><?php echo $benefit['text']; ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="industries_contact">
    <div class="container">
      <div class="row align-items-md-center">
        <div class="col-sm-5">
          <h2>CONTÁCTANOS PARA MAYOR INFORMACIÓN</h2>
        </div>
        <div class="col-md-4 offset-xl-2">
          <p>
            <i class="fa-solid fa-phone">+</i> <span id="tel_country">52 664 309534</span>
            <i>+</i> <span id="cel_country">52 664 1158473</span>
          </p>
        </div>
        <div class="col-xl-1 col-md-3 col-lg-2">
          <a href="#" class="btn">VENTAS</a>
        </div>
      </div>
    </div>
  </div>
  <div class="industries_applications">
    <div class="industries_applications_image">
      <img src="<?php echo base_url . 'img/' . $industry['applications']['image'] ?>" alt="" class="img-fluid">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2><?php echo $industry["applications"]["title"]; ?></h2>
        </div>
      </div>
      <div class="row industries_applications_details">
        <div class="col-sm-7 offset-sm-5">
          <div class="row">
            <?php
            foreach ($industry["applications"]["items"] as $key => $application) {
              $right = ($key % 2 == 0) ? '' : 'offset-xl-2';
            ?>
              <div class="col-lg-6 col-xl-5 <?php echo $right; ?>">
                <h3><?php echo $application["title"]; ?></h3>
                <p><?php echo $application["text"]; ?></p>
              </div>
            <?php } ?>
          </div>
        </div>
        <?php
        foreach ($industry["applications"]["downloads"] as $index => $download) {
        ?>
          <div class="col-sm-7 offset-sm-5">
            <a href="<?php echo $download['url']; ?>" target="_BLANK" class="requirement">
              <span>
                <img src="<?php echo base_url; ?>img/pdf.svg" alt="">
                <?php echo $download['title']; ?></span>
              <img src="<?php echo base_url; ?>img/gold-arrow.svg" alt="">
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="other_industries">
    <div class="container">
      <div class="row other_industries_title">
        <h3>OTRAS INDUSTRIAS DONDE APLICAMOS ACERO GALVANIZADO</h3>
      </div>
      <div class="row">
        <?php
        $counter = 1;
        foreach ($all_industries as $in => $one_industry) {
          if ($in != $_GET['secc']) {
            $offset = $counter == 1 ? "offset-lg-1" : "";
        ?>
            <div class="col-sm-4 col-lg-2 col-xl-2 <?php echo $offset; ?>">
              <img src="<?php echo base_url . 'img/' . $one_industry['image']; ?>" alt="<?php echo $one_industry['title']; ?> | Coatinc Company" class="img-fluid">
              <p><?php echo $one_industry['title']; ?></p>
            </div>
        <?php
            $counter++;
          }
        }
        ?>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="<?php echo base_url; ?>js/slick/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.hero_industries_slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        infinite: true,
        slidesToShow: 1,
        SlidesToScroll: 1,
        centerMode: true,
        centerPadding: '270px',
        responsive: [{
            breakpoint: 480,
            settings: {
              centerPadding: '0px',
            }
          },
          {
            breakpoint: 992,
            settings: {
              centerPadding: '50px',
            }
          }
        ]
      })
    })
  </script>
</body>

</html>