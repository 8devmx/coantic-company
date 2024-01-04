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
        <a href="blog">Todos los artículos</a>
      </div>
    </div>
  </div>
  <div class="container blog_post">
    <div class="row">
      <div class="col-lg-12 col-md-10 offset-md-1 offset-lg-0">
        <h1>Éste es el H1 del artículo</h1>
        <img src="img/blog_interna.jpg" class="img-fluid">
        <h2>Éste es el H2 del artículo</h2>
        <p>Dictum turpis consectetur facilisis curae purus blandit potenti amet a ante a ullamcorper cubilia nisl. Pharetra parturient fusce suspendisse in eros aliquam consectetur a suspendisse ultricies aliquam a suspendisse aptent fringilla pretium hac eleifend parturient venenatis. Et vel nec interdum eget tempus a ullamcorper sapien sed torquent lobortis lacus at vivamus.</p>
        <h3>Éste es el H2 del artículo</h3>
        <h4>Éste es el H3 del artículo</h4>
        <p>Dictum turpis consectetur facilisis curae purus blandit potenti amet a ante a ullamcorper cubilia nisl. Pharetra parturient fusce suspendisse in eros aliquam consectetur a suspendisse ultricies aliquam a suspendisse aptent fringilla pretium hac eleifend parturient venenatis. Et vel nec interdum eget tempus a ullamcorper sapien sed torquent lobortis lacus at vivamus.</p>
        <h5>Éste es el H4 del artículo</h5>
        <p>A suspendisse suscipit fames senectus lacus placerat ullamcorper libero maecenas netus dui ad dignissim imperdiet euismod dui integer aliquet. Vestibulum a suspendisse hac euismod condimentum arcu parturient a sociis dis ac bibendum fermentum placerat a adipiscing sit potenti quam sed. A suspendisse parturient egestas scelerisque est et sagittis consectetur morbi tristique etiam suscipit euismod suspendisse vestibulum hendrerit nisl sem dignissim a fames ac commodo. Torquent parturient at enim a integer adipiscing pharetra mi rhoncus ullamcorper pharetra malesuada consequat lorem curae adipiscing tortor consectetur consectetur a cum vulputate scelerisque lacinia a dignissim.</p>

        <p>Sem vel suspendisse pulvinar nam parturient in ut parturient tempus faucibus sodales sem magna elementum torquent consectetur a diam lorem mauris elit habitant cum sem bibendum mollis vestibulum vestibulum. Luctus cras dis adipiscing vel suscipit sagittis scelerisque at scelerisque a dignissim duis dis pharetra conubia etiam a. A sem vestibulum in nostra placerat ridiculus quam a varius eu mauris libero natoque turpis nulla scelerisque vitae id at. Ullamcorper risus accumsan quam a suspendisse tempus etiam quis nam iaculis malesuada donec ante feugiat cum condimentum ac pulvinar suspendisse nascetur scelerisque ultrices in vestibulum elit suscipit a vel.</p>

        <p>Ut felis vel ac felis euismod molestie egestas a metus eu erat vestibulum bibendum parturient sit odio sem est condimentum a habitasse curabitur euismod conubia ut condimentum ullamcorper per. Non a parturient quis a justo dis euismod dis enim curabitur vitae morbi a mi conubia mauris proin. Quis pretium enim parturient parturient taciti in himenaeos scelerisque vivamus a parturient suspendisse rhoncus suspendisse dui justo fringilla. Tristique blandit conubia suspendisse est convallis tellus lacus a vestibulum habitant adipiscing a sem aptent a sodales urna eget mi semper a. Adipiscing habitant a a sociis metus condimentum feugiat proin sed vehicula suspendisse lacinia felis diam enim eu vivamus molestie sed facilisis ullamcorper sit mi parturient orci felis nulla inceptos. Vel potenti tincidunt gravida adipiscing dolor a sapien proin posuere ut laoreet dignissim pulvinar felis elementum a consequat adipiscing magna vestibulum cursus nulla adipiscing.</p>
        <h6>Éste es el H6 del artículo</h6>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="slider_blog_interna">
          <img src="img/blog_interna_slider.jpg" alt="">
          <img src="img/blog_interna_slider.jpg" alt="">
          <img src="img/blog_interna_slider.jpg" alt="">
          <img src="img/blog_interna_slider.jpg" alt="">
          <img src="img/blog_interna_slider.jpg" alt="">
          <img src="img/blog_interna_slider.jpg" alt="">
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