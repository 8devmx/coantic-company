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

    $sqlValida = "SELECT COUNT(id_ind) AS existe FROM industrias WHERE activo_ind = 1 AND url_ind = '" . trim($url_ser) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $db->insert("industrias", [
            "titulo_ind" => $_POST["titulo"],
            "subtitulo_ind" => $_POST["subtitulo"],
            "beneficios_ind" => $_POST["beneficios"],
            "beneficios_elementos_ind" => $_POST["benefits"],
            "aplicaciones_ind" => $_POST["aplicaciones"],
            "aplicaciones_imagen_ind" => $_POST["foto_prod"],
            "slider_ind" => $galeria_ser,
            "descargas_ind" => $_POST["downloads"],
            "fechaact_ind" => $fechareg,
            "url_ind" => $url_ser,
        ]);
        $idInsert = $db->id();
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

    $sql = "SELECT * FROM industrias WHERE (activo_ind = 1 OR activo_ind = 2) ORDER BY titulo_ind ASC ";
    $res = $db->query($sql)->fetchAll();

    $datos = array();

    foreach ($res as $rows) {

        $idfolio = str_pad($rows['id_ind'], 6, 0, STR_PAD_LEFT);

        $datos[] = array(
            'titulo' => $rows['titulo_ind'],
            'url' => $rows['url_ind'],
            'fechaact' => obtenerDiaSemana($rows['fechaact_ind']),
            'horaact' => obtenerHoraFecha($rows['fechaact_ind']),
            'id' => $rows['id_ind'],
            'activo' => $rows['activo_ind'],
            'idtxt_ser' => "C" . $idfolio
        );
    }

    echo json_encode($datos);
}

function consultar()
{
    global $db;

    $sql = "SELECT * FROM industrias WHERE id_ind = " . $_POST["id"];
    $res = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $datos = array();
    $datos[] = array(
        'titulo' => $res[0]['titulo_ind'],
        'subtitulo' => $res[0]['subtitulo_ind'],
        'beneficios' => $res[0]['beneficios_ind'],
        'beneficios_elementos' => $res[0]['beneficios_elementos_ind'],
        'aplicaciones' => $res[0]['aplicaciones_ind'],
        'aplicaciones_imagen' => $res[0]['aplicaciones_imagen_ind'],
        'aplicaciones_imagen_url' => "../../../uploads/industrias/" . $res[0]['aplicaciones_imagen_ind'],
        'galeria' => (($res[0]['slider_ind'] == null || $res[0]['slider_ind'] == "") ? "**" : $res[0]['slider_ind']),
        'descargas' => $res[0]['descargas_ind'],
        'url' => $res[0]['url_ind'],
        'id' => $res[0]['id_ind']
    );

    $_SESSION["idses_ind"] = $res[0]['id_ind'];

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

    $sqlValida = "SELECT COUNT(id_ind) AS existe FROM industrias WHERE activo_ind = 1 AND id_ind != " . $_SESSION['idses_ind'] . " AND url_ind = '" . trim($url_ser) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $resp = $db->update("industrias", [
            "titulo_ind" => $_POST["titulo"],
            "subtitulo_ind" => $_POST["subtitulo"],
            "beneficios_ind" => $_POST["beneficios"],
            "beneficios_elementos_ind" => $_POST["benefits"],
            "aplicaciones_ind" => $_POST["aplicaciones"],
            "aplicaciones_imagen_ind" => $_POST["foto_prod"],
            "slider_ind" => $galeria_ser,
            "descargas_ind" => $_POST["downloads"],
            "fechaact_ind" => $fechareg,
            "url_ind" => $url_ser,
        ], ["id_ind" => $_SESSION['idses_ind']]);

        if ($resp->rowCount()) {
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

//     $resp = $db->update("industrias", [
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

    $sqlValida = "SELECT COUNT(id_ser) AS existe FROM industrias WHERE activo_ser = 1 AND url_ser = '" . trim($url_ser) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $sql = "INSERT INTO industrias 
        (url_ser, titulo, desc_ser, video_ser, foto_ser, pdf_ser, galeria_ser, texto1_ser, texto2_ser, texto3_ser, bullets1_ser, bullets2_ser, bullets3_ser, fechareg_ser, fechaact_ser) 
        SELECT '" . $url_ser . "', '" . $_POST['titulo-duplicar'] . "', desc_ser, video_ser, foto_ser, pdf_ser, galeria_ser, texto1_ser, texto2_ser, texto3_ser, bullets1_ser, bullets2_ser, bullets3_ser, '" . $fechareg . "', '" . $fechareg . "' 
        FROM industrias 
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

    $resp = $db->update("industrias", [
        "activo_ind" => (($post['valor'] == "") ? 0 : $post['valor']),
        "fechaact_ind" => $fechareg
    ], ["id_ind" => $post['id']]);

    echo $resp;
}
