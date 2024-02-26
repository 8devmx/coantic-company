<?php
include("../../includes/_funciones.php");

//Comprobamos que sea una petición ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    //Obtenemos el archivo a subir
    $file = $_FILES['archivo']['name'];
    $partes_nombre = explode(".", $file);
    $extension = strtolower(end($partes_nombre));

    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $nombre = time() . "." . $ext;


    if ($extension == "png" || $extension == "jpeg" || $extension == "jpg" || $extension == "gif" || $extension == "svg") {
        //Comprobamos si existe un directorio para subir el archivo
        //Si no es así, lo creamos
        if (!is_dir("../../../uploads/blog/"))
            mkdir("../../../uploads/blog/", 0777);
        //comprobamos si el archivo ha subido
        if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], "../../../uploads/blog/" . $nombre)) {
            sleep(3); //retrasamos la petición 3 segundos
            //devolvemos el nombre del archivo para pintar la imagen
        }
        //Thumb
        create_square_image("../../../uploads/blog/" . $nombre, "../../../uploads/blog/thumb/" . $nombre, 300);
        echo $nombre;
    } else {
        echo "novalido";
    }
} else {
    throw new Exception("Error Processing Request", 1);
}
