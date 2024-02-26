<?php
require_once 'includes/_functions.php';
$posts = $db->select("blog", "*", ["activo_blog" => 1]);
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
      foreach ($posts as $key => $post) {
      ?>
        <div class="col-sm-6 blog_post">
          <a href="<?php echo base_url; ?>blog/<?php echo $post['url_blog']; ?>">
            <img src="uploads/blog/<?php echo $post['foto_blog']; ?>" alt="<?php echo $post['title']; ?>" class="img-fluid">
            <h2><?php echo $post['nom_blog']; ?></h2>
            <h3><?php echo $post['texto1_blog']; ?></h3>
          </a>
        </div>
      <?php
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