<?php
$posts = [
  [
    "img" => "blog_1.jpg",
    "title" => "Éste es el H1 del artículo",
    "subtitle" => "Éste es el H2 del artículo"
  ],
  [
    "img" => "blog_2.jpg",
    "title" => "Éste es el H1 del artículo",
    "subtitle" => "Éste es el H2 del artículo"
  ]
];
?>

<!DOCTYPE html>
<html lang="es-MX">

<head>
  <?php require_once 'includes/scripts.php'; ?>
</head>

<body>
  <?php require_once 'includes/_header.php'; ?>
  <div class="hero_products_detail hero_blog">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1>BLOG</h1>
          <p>Encuentra todo lo que necesitas saber sobre Acero Galvanizado</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container blog_posts">
    <div class="row">
      <?php
      for ($i = 0; $i < 4; $i++) {
        foreach ($posts as $key => $post) {
      ?>
          <div class="col-sm-6">
            <img src="img/<?php echo $post['img']; ?>" alt="<?php echo $post['title']; ?>" class="img-fluid">
            <h2><?php echo $post['title']; ?></h2>
            <h3><?php echo $post['subtitle']; ?></h3>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
  <div class="container blog_posts_pagination">
    <div class="row">
      <div class="col-sm-12">
        <ul class="pagination">
          <li>
            <a href="#">1</a>
          </li>
          <li>
            <a href="#">2</a>
          </li>
          <li>
            <a href="#">3</a>
          </li>
          <li>
            <a href="#">4</a>
          </li>
          <li>
            <a href="#">5</a>
          </li>
          <li>
            <a href="#">6</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <?php require_once 'includes/_footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/slick/slick.min.js"></script>
</body>

</html>