<?php

function get_filename_page()
{
  return basename($_SERVER['PHP_SELF']);
}

function get_base_url()
{
  if ($_SERVER['HTTP_HOST'] == "localhost") {
    $carpetaProyecto = "coantic-company/";
    define("base_url", "http://" . $_SERVER['HTTP_HOST'] . "/" . $carpetaProyecto); // RUTA ABSOLUTA DEL SITIO
  } else {
    $carpetaProyecto = "coantic-company/"; // si es un beta se debe de poner: beta/
    define("base_url", "https://" . $_SERVER['HTTP_HOST'] . "/" . $carpetaProyecto); // RUTA ABSOLUTA DEL SITIO
  }
}

get_base_url();
