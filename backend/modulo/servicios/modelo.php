<?php
include("../../includes/_funciones.php");
page_protect();
if ($_POST) {
    switch ($_POST['accion']) {
        case 'guardar':
            guardar();
            break;
        case 'listar':
            listar();
            break;
        case 'consultar':
            consultar();
            break;
        case 'editar':
            editar();
            break;
        case 'duplicar':
            duplicar();
            break;
        case 'eventoActivo':
            eventoActivo();
            break;
    }
}

function guardar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $url_ser = replaceUrl($_POST['titulo']);
    $galeria_ser = "";

    $countGaleria = strlen($_POST["galeria_prod"]);
    if ($countGaleria > 1) {
        $galeria_ser = $_POST["galeria_prod"];
    } else {
        $galeria_ser = "**";
    }

    $sqlValida = "SELECT COUNT(id_ser) AS existe FROM servicios WHERE activo_ser = 1 AND url_ser = '" . trim($url_ser) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $idInsert = $db->insert("servicios", [
            "url_ser" => $url_ser,
            "titulo_ser" => $_POST["titulo"],
            "subtitulo_ser" => $_POST["subtitulo"],
            "descripcion_ser" => $_POST["descripcion"],
            "hero_ser" => $_POST["foto_prod"],
            "beneficios_imagen_ser" => $_POST["pdf_prod"],
            "slider_ser" => $galeria_ser,
            "beneficios_ser" => $_POST["beneficios"],
            "caracteristicas_ser" => $_POST["caracteristicas"],
            "acerca_ser" => $_POST["acerca"],
            "extras_ser" => $_POST["extras"],
            "descargas_ser" => $_POST["downloads"],
            "fechaact_ser" => $fechareg,
        ]);

        if ($idInsert > 0) {
            $resp = $idInsert;
        } else {
            $resp = "No se registro";
        }
    } else {
        $resp = "existe";
    }

    echo $resp;
}

function listar()
{
    global $db;

    $sql = "SELECT * FROM servicios WHERE (activo_ser = 1 OR activo_ser = 2) ORDER BY titulo_ser ASC ";
    $res = $db->query($sql)->fetchAll();

    $datos = array();

    foreach ($res as $rows) {

        $idfolio = str_pad($rows['id_ser'], 6, 0, STR_PAD_LEFT);

        $datos[] = array(
            'titulo' => $rows['titulo_ser'],
            'url' => $rows['url_ser'],
            'fechaact' => obtenerDiaSemana($rows['fechaact_ser']),
            'horaact' => obtenerHoraFecha($rows['fechaact_ser']),
            'id' => $rows['id_ser'],
            'activo' => $rows['activo_ser'],
            'idtxt_ser' => "C" . $idfolio
        );
    }

    echo json_encode($datos);
}

function consultar()
{
    global $db;

    $sql = "SELECT * FROM servicios WHERE id_ser = " . $_POST["id"];
    $res = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $datos = array();
    $datos[] = array(
        'url' => $res[0]['url_ser'],
        'titulo' => $res[0]['titulo_ser'],
        'titulo' => $res[0]['titulo_ser'],
        'subtitulo' => $res[0]['subtitulo_ser'],
        'hero' => $res[0]['hero_ser'],
        'hero_url' => "../../../uploads/servicios/" . $res[0]['hero_ser'],
        'galeria' => (($res[0]['slider_ser'] == null || $res[0]['slider_ser'] == "") ? "**" : $res[0]['slider_ser']),
        'descripcion' => $res[0]['descripcion_ser'],
        'beneficios' => $res[0]['beneficios_ser'],
        'descargas' => $res[0]['descargas_ser'],
        'beneficios_imagen' => $res[0]['beneficios_imagen_ser'],
        'beneficios_imagen_url' => "../../../uploads/servicios/" . $res[0]['beneficios_imagen_ser'],
        'acerca' => $res[0]['acerca_ser'],
        'caracteristicas' => $res[0]['caracteristicas_ser'],
        'extras' => $res[0]['extras_ser'],
        'id' => $res[0]['id_ser']
    );

    $_SESSION["idses_ser"] = $res[0]['id_ser'];

    // convertimos el array de datos a formato json
    echo json_encode($datos);
}

function editar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $url_ser = replaceUrl($_POST['titulo']);

    $galeria_ser = "";

    $countGaleria = strlen($_POST["galeria_prod"]);
    if ($countGaleria > 1) {
        $galeria_ser = $_POST["galeria_prod"];
    } else {
        $galeria_ser = "**";
    }

    $sqlValida = "SELECT COUNT(id_ser) AS existe FROM servicios WHERE activo_ser = 1 AND id_ser != " . $_SESSION['idses_ser'] . " AND url_ser = '" . trim($url_ser) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $resp = $db->update("servicios", [
            "url_ser" => $url_ser,
            "titulo_ser" => $_POST["titulo"],
            "subtitulo_ser" => $_POST["subtitulo"],
            "descripcion_ser" => $_POST["descripcion"],
            "hero_ser" => $_POST["foto_prod"],
            "beneficios_imagen_ser" => $_POST["pdf_prod"],
            "slider_ser" => $galeria_ser,
            "beneficios_ser" => $_POST["beneficios"],
            "caracteristicas_ser" => $_POST["caracteristicas"],
            "acerca_ser" => $_POST["acerca"],
            "extras_ser" => $_POST["extras"],
            "descargas_ser" => $_POST["downloads"],
            "fechaact_ser" => $fechareg,
        ], ["id_ser" => $_SESSION['idses_ser']]);

        if (!$resp) {

            $respuesta = "=> " . implode(" | ", $db->error());
        } else {
            $respuesta = 1;
        }
    } else {
        $respuesta = "existe";
    }

    echo $respuesta;
}

// function eliminar() {
//     global $db;
//     date_default_timezone_set("America/Mexico_City");
//     $fecha =  date("Y-m-d");
//     $hora = date("H:i:s");
//     $fechareg = $fecha." ".$hora;

//     $resp = $db->update("servicios", [
//         "activo_ser" => 0,
//         "fechaact_ser" => $fechareg
//     ], ["id_ser" => $_POST['id_ser'] ]);

//     echo $resp;
// }

function duplicar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $url_ser = replaceUrl($_POST['titulo-duplicar']);

    $sqlValida = "SELECT COUNT(id_ser) AS existe FROM servicios WHERE activo_ser = 1 AND url_ser = '" . trim($url_ser) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $sql = "INSERT INTO servicios 
        (url_ser, titulo, desc_ser, video_ser, foto_ser, pdf_ser, galeria_ser, texto1_ser, texto2_ser, texto3_ser, bullets1_ser, bullets2_ser, bullets3_ser, fechareg_ser, fechaact_ser) 
        SELECT '" . $url_ser . "', '" . $_POST['titulo-duplicar'] . "', desc_ser, video_ser, foto_ser, pdf_ser, galeria_ser, texto1_ser, texto2_ser, texto3_ser, bullets1_ser, bullets2_ser, bullets3_ser, '" . $fechareg . "', '" . $fechareg . "' 
        FROM servicios 
        WHERE id_ser = '" . $_POST['idhid_ser'] . "'; ";

        $res = $db->query($sql);

        if (!$res) {
            $respuesta = "=>" . $db->error();
        } else {
            $respuesta = 1;
        }
    } else {
        $respuesta = "existe";
    }

    echo $respuesta;
}

function eventoActivo()
{
    global $db;
    foreach ($_POST as $key => $value) {
        $post[$key] = filtro($value);
    }
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $resp = $db->update("servicios", [
        "activo_ser" => (($post['valor'] == "") ? 0 : $post['valor']),
        "fechaact_ser" => $fechareg
    ], ["id_ser" => $post['id']]);

    echo $resp;
}
