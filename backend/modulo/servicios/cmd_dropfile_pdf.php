<?php

//Comprobamos que sea una petición ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    //Obtenemos la foto a subir
    require("../../includes/_funciones.php");
    $datos = array();
    $respuesta = 0;
    $nombre = $_FILES["archivopdf"]["name"];
    $nombre_tmp = $_FILES["archivopdf"]["tmp_name"];
    $tipo = $_FILES["archivopdf"]["type"];
    $tamano = $_FILES["archivopdf"]["size"];

    $partes_nombre = explode(".", $nombre);
    $extension = strtolower(end($partes_nombre));
    $var_rand = rand(10000, 999999) * rand(10000, 999999);
    //$nombre_tem = md5($var_rand.$nombre);
    $nombre_tem = time();
    //$nuevoNombre = $nombre_tem.".".$extension;
    $nuevoNombre = $nombre_tem . "." . $extension;
    $directorio = "../../../uploads/servicios/";
    $ruta_archivo = "../../../uploads/servicios/" . $nuevoNombre;

    if ($extension == "png" || $extension == "jpeg" || $extension == "jpg" || $extension == "gif" || $extension == "svg") {

        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }

        if ($nombre && move_uploaded_file($nombre_tmp, $ruta_archivo)) {

            //create_square_image($ruta_archivo,$directorio."thumb/".$nuevoNombre,150);//150x150 REVISAR FUNCION YA QUE MARCA ERROR: 1 NOV 2018

            $array["respuesta"] = 1;
            $array["nom_imagen"] = $nuevoNombre;
            $array["url_imagen"] = $ruta_archivo;
            $array["extension"] = $extension;
            $array["error"] = "Se cargo correctamente";
        } else {
            $array["respuesta"] = 0;
            $array["nom_imagen"] = "";
            $array["url_imagen"] = "";
            $array["extension"] = "";
            $array["error"] = "(" . $directorio . "" . $nombre . ")";
        }
    } else {
        $array["respuesta"] = 2;
        $array["nom_imagen"] = "";
        $array["url_imagen"] = "";
        $array["extension"] = $extension;
        $array["error"] = "No es un archivo valido pdf (" . $extension . ")";
    }

    $datos[] = $array;
    echo (json_encode($datos));
} else {
    throw new Exception("Error Processing Request", 1);
}

function limpiarEspacios($cadena)
{
    $cadena = str_replace(' ', '-', $cadena);
    return $cadena;
} //END function
