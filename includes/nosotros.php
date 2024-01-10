<?php

$nosotros = [
  "ubicaciones" => [
    "title" => "Ubicaciones",
    "icon" => "fa-globe"
  ],
  "historia" => [
    "title" => "Historia",
    "icon" => "fa-list-ul"
  ],
  "sustentabilidad" => [
    "title" => "Sustentabilidad",
    "icon" => "fa-leaf"
  ],
  "filosofia" => [
    "title" => "Nuestra filosofía",
    "icon" => "fa-book"
  ]
];

$current_page = str_replace(".php", "", get_filename_page());
foreach ($nosotros as $key => $item) {
  if ($current_page != $key) {
?>
    <div class="col-sm-4">
      <a href="<?php echo base_url . $key; ?>" class="button_link"><i class="fa <?php echo $item['icon']; ?>" aria-hidden="true"></i> <?php echo $item['title']; ?></a>
    </div>
<?php
  }
}
?>