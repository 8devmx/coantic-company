<?php
include("../../includes/_funciones.php");

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $file = $_FILES['archivo']['name'];
    $partes_nombre = explode(".", $file);
    $extension = strtolower(end($partes_nombre));

    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $nombre = time() . "." . $ext;


    if ($extension == "png" || $extension == "jpeg" || $extension == "jpg" || $extension == "gif" || $extension == "svg") {
        if (!is_dir("../../../uploads/servicios/"))
            mkdir("../../../uploads/servicios/", 0777);
        if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], "../../../uploads/servicios/" . $nombre)) {
            sleep(3);
        }
        create_square_image("../../../uploads/servicios/" . $nombre, "../../../uploads/servicios/thumb/" . $nombre, 300);
        echo $nombre;
    } else {
        echo "novalido";
    }
} else {
    throw new Exception("Error Processing Request", 1);
}
